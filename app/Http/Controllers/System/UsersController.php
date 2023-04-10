<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\AdminUser;
use Illuminate\Http\Request;
use App\Traits\Admin\LayoutTrait;
use App\Traits\Admin\UploadFileTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class UsersController extends Controller
{
    use LayoutTrait;
    use UploadFileTrait;

    public $settings = [
        'model' =>  '\\App\\Models\\User',
        'caption' =>  "User",
        'xFolder' =>  "Admin/Pages/Users",
        'indexRoute' =>  "/system/users",
        'storageName' =>  "users",
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
        'isReltionship' => false,
        'relationName' => "",
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
        $this->setup['usertypes'] = $this->defaultModel::options('user_category');
        $this->setup['tableName'] = $this->defaultModel::getTableName();
        $this->def_constructor();
    }
    public function index(){
        $this->def_index();
        return Inertia::render($this->settings['xFolder'].'/Index',$this->viewData);
    }
    public function create(){
        $this->def_create();
        return Inertia::render($this->settings['xFolder'].'/CreateEdit',$this->viewData);
    }
    public function store(REQUEST $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'user_category' => 'required',
            'status' => 'required',
        ]);
        DB::beginTransaction();
        try{
            $this->pKey = $request->uuid == 'null'? null:$request->uuid;
            $record = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make(12345678),
                'user_category' => $request->user_category,
                'status' => $request->status,
            ];
           
            if($this->pKey == null){
                $record['created_by'] = Auth::user()->email;
            }else{
                $record['updated_by'] = Auth::user()->email;
            }
            $this->defaultModel::updateOrCreate(["uuid" => $this->pKey], $record);
            if ($request->user_category == 100) {
                $record = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'role' => 1,
                    'status' => 1,
                    'created_by' => Auth::user()->email,
                    'updated_by' => Auth::user()->email,
                    
                ];
                AdminUser::updateOrCreate(["email" => $request->email], $record);
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
