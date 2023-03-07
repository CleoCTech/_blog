<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post\Category;
use App\Models\Post\CategorySubCategory;
use Illuminate\Http\Request;
use App\Traits\Admin\LayoutTrait;
use App\Traits\Admin\UploadFileTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class SubCategoryController extends Controller
{
    use LayoutTrait;
    use UploadFileTrait;

    public $settings = [
        'model' =>  '\\App\\Models\\Post\\SubCategory',
        'caption' =>  "Sub Categories",
        'xFolder' =>  "Admin/Pages/CategorySubCategories",
        'indexRoute' =>  "/admin/category-post-sub-categories",
        'storageName' =>  "sub-categories",
        'isList' => true,
        'isCreate' => true,
        'isView' => true,
        'isEdit' => true,
        'isDelete' => true,
        'isActions' => true,
        'isAttachments' => true,
        'isReports' => false,
        'isCharts' => false,
        'isSearch' => true,
        'isReltionship' => true,
        'relationName' => "categories",
        'isSelect' => true,
        'isMoreActions' => false,
        'xMoreActions' => null,
        'isExport' => false,
        'orderBy' => ['column' => 'created_at', 'order' => 'DESC'],
    ];
    public function __construct(){
        $this->middleware('gen-auth');
        $this->middleware('admin-auth');
        $this->defaultModel = $this->settings['model'];
        $this->isReltionship = $this->settings['isReltionship'];
        $this->relationName = $this->settings['relationName'];
        $this->setup['statuses'] = $this->defaultModel::options('status');
        $this->setup['tableName'] = $this->defaultModel::getTableName();
        $this->def_constructor();
    }
    public function index(){
        $this->def_index();
       
        return Inertia::render($this->settings['xFolder'].'/Index',$this->viewData);
    }
    public function create(){
        $this->def_create();
        $categories = Category::all();
        $this->viewData['categories'] = $categories; 
        return Inertia::render($this->settings['xFolder'].'/CreateEdit',$this->viewData);
    }
    public function store(REQUEST $request){
        $this->validate($request, [
            'title' => 'required',
            'description' => 'nullable',
            'sequence' => 'nullable',
            'kategories' => 'required',
            'status' => 'required',
            'publish_time' => 'nullable|required_if:status,=,3',
        ]);
        
       
        DB::beginTransaction();
        try{
            $this->pKey = $request->uuid == 'null'? null:$request->uuid;
            $record = [
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
                'sequence' => $request->sequence,
                'publish_time' => $request->publish_time,
            ];
            if($request->status != 3){
                $record['publish_time'] = null;
            }
            if($this->pKey == null){
                $record['created_by'] = Auth::user()->email;
            }else{
                $record['updated_by'] = Auth::user()->email;
            }
            $return_value = $this->defaultModel::updateOrCreate(["uuid" => $this->pKey], $record);
            // $return_value
            // Delete all records where the "sub-category" column is set to "$return_value->id"
            CategorySubCategory::where('sub_category_id', $return_value->id)->delete();

            $string = $request->kategories;
            $kategories = explode(",", $string);
            // info($request->kategories);
            foreach ($kategories as $key => $kategory) {
                $category = Category::where('uuid', $kategory)->first();
                CategorySubCategory::create([
                    'sub_category_id' =>$return_value->id,
                    'category_id' =>$category->id,
                    'created_by' =>Auth::user()->email,
                ]);
            }
            if($this->isCommit){
                DB::Commit();
                $response = $this->notification('success');
                return response()->json($response,200);
            }else{
                DB::rollback();
                $response = $this->notification('error');
                return response()->json($response,500);
            }
        }catch(\Exception $e){
            DB::rollback();
            Log::error($e);
            $response = $this->notification('error');
            return response()->json($response,500);
        }
    }
    public function show($uuid){
        $this->def_show($uuid);
        return Inertia::render($this->settings['xFolder'].'/Show',$this->viewData);
    }
    public function edit($uuid){
        $this->def_edit($uuid);
        $categories = Category::all();
        $this->viewData['categories'] = $categories;
        if($this->viewData['cardData']['status'] == 3){
            $this->viewData['cardData']['publish_time2'] = $this->viewData['cardData']['publish_time']->format('Y-m-d\TH:i');
        }
        return Inertia::render($this->settings['xFolder'].'/CreateEdit',$this->viewData);
    }
    public function destroy($uuid){
        $user = $this->defaultModel::where('uuid',$uuid)->first();
        $user->delete();
        $response = $this->notification('deleteSuccess');
        return response()->json($response,200);
    }
    public function report($name){
        $this->defReport();
        $this->viewData['name'] = $name;
        $this->viewData['fileName'] = 'destinations-report.pdf';
        $this->viewData['dataItems'][0]['relationships'] = 'solutions';
        $this->viewData['dataItems'][1] = [
            'model' => 'App\\Models\\Solution',
            'columns' => $this->defaultModel::getTableColumns('solutions'),
            'caption' => 'Solutions Dataset',
        ];
        return $this->viewData;
    }
}
