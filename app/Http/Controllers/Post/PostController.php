<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post\Category;
use App\Models\Post\CategoryPost;
use App\Models\Post\MetaPost;
use App\Models\Post\SubCategory;
use App\Models\Post\SubCategoryPost;
use App\Models\Post\Tag;
use App\Models\Post\TagPost;
use Illuminate\Http\Request;
use App\Traits\Admin\LayoutTrait;
use App\Traits\Admin\UploadFileTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class PostController extends Controller
{
    use LayoutTrait;
    use UploadFileTrait;

    public $settings = [
        'model' =>  '\\App\\Models\\Post\\Post',
        'caption' =>  "Posts",
        'xFolder' =>  "Admin/Pages/Posts",
        'indexRoute' =>  "/admin/post",
        'storageName' =>  "posts",
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
        'relationName' => ['categories','sub_categories', 'tags', 'meta'],
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
        $this->setup['visibilities'] = $this->defaultModel::options('visibility');
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
        $sub_categories = SubCategory::all();
        $tags = Tag::all();
        $this->viewData['categories'] = $categories;
        $this->viewData['sub_categories'] = $sub_categories;
        $this->viewData['tags'] = $tags;
        return Inertia::render($this->settings['xFolder'].'/CreateEdit',$this->viewData);
    }
    public function store(REQUEST $request){
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'featured_image' => 'nullable',
            'kategories' => 'required',
            'sub_kategories' => 'required',
            'tagss' => 'nullable',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'sequence' => 'nullable',
            'status' => 'required',
            'visibility' => 'required',
            'publish_time' => 'nullable|required_if:status,=,3',
        ]);
        
        DB::beginTransaction();
        try{
            if($request->hasFile('featured_image')){
                $fileName = $this->generateFileName($request->file('featured_image'));
            }
            $this->pKey = $request->uuid == 'null'? null:$request->uuid;
            $record = [
                'title' => $request->title,
                'content' => $request->content,
                'featured_image' => $request->featured_image,
                'user_id' => Auth::user()->id,
                'status' => $request->status,
                'visibility' => $request->visibility,
                'sequence' => $request->sequence,
                'publish_time' => $request->publish_time,
            ];
            if($request->hasFile('featured_image')){
                $record['featured_image'] = $fileName;
            }
            if($request->status != 3){
                $record['publish_time'] = null;
            }
            if($this->pKey == null){
                $record['created_by'] = Auth::user()->email;
            }else{
                $record['updated_by'] = Auth::user()->email;
            }
            $return_value = $this->defaultModel::updateOrCreate(["uuid" => $this->pKey], $record);
            if($request->hasFile('featured_image')){
                $fileData = ['file' => $request->file('featured_image'),'fileName' => $fileName, 'storageName' => $this->settings['storageName'].'\\posts','prevFile' => $this->prevRecord != null? $this->prevRecord['featured_image']:null];
                if(!$this->uploadFile($fileData)){
                    $this->isCommit = false;
                }
            }
            $string = $request->kategories;
            $string2 = $request->sub_kategories;
            $kategories = explode(",", $string);
            $sub_kategories = explode(",", $string2);
            // $return_value
            // Delete all records where the "category_posts" column is set to "$return_value->id"
            CategoryPost::where('post_id', $return_value->id)->delete();
            foreach ($kategories as $key => $kategory) {
                $category = Category::where('uuid', $kategory)->first();
                CategoryPost::create([
                    'post_id' =>$return_value->id,
                    'category_id' =>$category->id,
                    'created_by' =>Auth::user()->email,
                ]);
            }
            SubCategoryPost::where('post_id', $return_value->id)->delete();
            foreach ($sub_kategories as $key => $kategory) {
                $category = SubCategory::where('uuid', $kategory)->first();
                SubCategoryPost::create([
                    'post_id' =>$return_value->id,
                    'sub_category_id' =>$category->id,
                    'created_by' =>Auth::user()->email,
                ]);
            }
            if ($request->has('tagss')) {
                TagPost::where('post_id', $return_value->id)->delete();
                $string = $request->tagss;
                $tags = explode(",", $string);
                foreach ($tags as $key => $tag) {
                    $tag = Tag::where('uuid', $tag)->first();
                    TagPost::create([
                        'post_id' =>$return_value->id,
                        'tag_id' =>$tag->id,
                        'created_by' =>Auth::user()->email,
                    ]);
                }
            }
            if ($request->has('seo_title')) {
                $category = MetaPost::where('post_id', $return_value->id)->delete();
                MetaPost::create([
                    'post_id' =>$return_value->id,
                    'seo_title' =>$request->seo_title,
                    'seo_description' =>$request->seo_description,
                    'status' =>2,
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
        $sub_categories = SubCategory::all();
        $tags = Tag::all();
        $this->viewData['categories'] = $categories;
        $this->viewData['sub_categories'] = $sub_categories;
        $this->viewData['tags'] = $tags;
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
