<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Traits\Admin\LayoutTrait;
use App\Traits\Admin\UploadFileTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CompanyInformationController extends Controller
{
    use LayoutTrait;
    use UploadFileTrait;

    public $settings = [
        'model' =>  '\\App\\Models\\System\\CompanyInformation',
        'caption' =>  "Company Information",
        'xFolder' =>  "System/Pages/CompanyInformation",
        'indexRoute' =>  "/system/company-information",
        'storageName' =>  "companyInfo",
        'isList' => true,
        'isCreate' => false,
        'isView' => true,
        'isEdit' => true,
        'isDelete' => false,
        'isActions' => true,
        'isAttachments' => true,
        'isReports' => false,
        'isCharts' => false,
        'isSearch' => false,
        'isReltionship' => false,
        'relationName' => "",
        'isSelect' => false,
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
        $this->def_constructor();
    }
    public function index(){
        $this->def_index();
        return Inertia::render($this->settings['xFolder'].'/Index',$this->viewData);
    }
    public function store(REQUEST $request){
        $this->validate($request, [
            'name' => 'required',
            'shortName' => 'required',
            'establishmentDate' => 'required',
            'vision' => 'required',
            'mission' => 'required',
            'core_values' => 'required',
            'quality' => 'required',
            'history' => 'required',
            'location' => 'required',
            'about_newsletter' => 'required',
            'about' => 'required',
            'about_short' => 'required',
            'emails' => 'required',
            'phoneNumbers' => 'required',
            'address' => 'required',
            'manager_name' => 'required',
            'welcome_message' => 'required',
            // 'logo' => 'required',
        ]);
        ini_set('max_execution_time', 300); //300 seconds = 5 minutes
        DB::beginTransaction();
        try{
            $this->pKey = $request->uuid;
            if($request->hasFile('logo')){
                $fileName = $this->generateFileName($request->file('logo'));
            }
            if($request->hasFile('manager_image')){
                $fileName2 = $this->generateFileName($request->file('manager_image'));
            }
            $record = [
                'company_name' => $request->name,
                'short_name' => $request->shortName,
                'establishment_date' => $request->establishmentDate,
                'vision' => $request->vision,
                'mission' => $request->mission,
                'core_values' => $request->core_values,
                'quality' => $request->quality,
                'history' => $request->history,
                'location' => $request->location,
                'about_newsletter' => $request->about_newsletter,
                'about_short' => $request->about_short,
                'welcome_message' => $request->welcome_message,
                'about' => $request->about,
                'phone_numbers' => $request->phoneNumbers,
                'emails' => $request->emails,
                'address' => $request->address,
                'logo' => $request->logo,
                // 'manager_image' => $request->manager_image,
                'manager_name' => $request->manager_name,
                'manager_custom_title' => $request->manager_custom_title,
                'total_people_helped' => $request->total_people_helped,
                'welcome_message' => $request->welcome_message,
            ];
            if($request->hasFile('logo')){
                $record['logo'] = $fileName;
            }
            if($request->hasFile('manager_image')){
                $record['manager_image'] = $fileName2;
            }
            if($this->pKey == null){
                $record['created_by'] = Auth::user()->email;
            }else{
                $record['updated_by'] = Auth::user()->email;
            }
            $this->defaultModel::updateOrCreate(["uuid" => $this->pKey], $record);
            if($request->hasFile('logo')){
                $fileData = ['file' => $request->file('logo'),'fileName' => $fileName, 'storageName' => $this->settings['storageName'].'\\images','prevFile' => $this->prevRecord != null? $this->prevRecord['logo']:null];
                if(!$this->uploadFile($fileData)){
                    $this->isCommit = false;
                }
            }
            if($request->hasFile('manager_image')){
                $fileData = ['file' => $request->file('manager_image'),'fileName' => $fileName2, 'storageName' => $this->settings['storageName'].'\\manager','prevFile' => $this->prevRecord != null? $this->prevRecord['manager_image']:null];
                if(!$this->uploadFile($fileData)){
                    $this->isCommit = false;
                }
            }
            if($this->isCommit){
                DB::Commit();
                $response = $this->notification('success');
                info($response);
                return response()->json($response,200);
            }else{
                DB::rollback();
            }
        }catch(\Exception $e){
            DB::rollback();
            Log::error($e);
            $response = $this->notification($e->getMessage());
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

}
