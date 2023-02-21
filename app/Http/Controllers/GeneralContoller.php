<?php

namespace App\Http\Controllers;

use App\Models\System\AdminUser;
use App\Models\System\CompanyInformation;
use App\Models\System\SocialMedia;
use App\Models\System\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class GeneralContoller extends Controller
{

    public $pageTitle ='';
    public function __construct(){
        $this->middleware('gen-auth')->only('dashboard');
    }

    public function home()
    {
        $data = [];
        return Inertia::render('Guest/Pages/Home', $data);
    }

    public function dashboard()
    {
        if(Auth::user()->user_category == 100){

            $user = AdminUser::select('status','role')->where('email',Auth::user()->email)->first();
            if($user == null || $user->role == null){
                Auth::logout();
                return redirect('/login')->with('error','Oops! your authorization as an admin failed.');
            }
            $role = UserRole::find($user->role);
            // Log::info($role);
            if($role == null){
                Auth::logout();
                return redirect('/login')->with('error','Oops! the user has not been assigned a role in the system');
            }
            $user['profile_category'] = 'admin';
            $user['permissions'] = $role->permissions;
            Auth::user()->profile = $user;
            return redirect('/admin/dashboard');
        }else{
            Log::info('Admin Dashboard`');
            return Inertia::render('Admin/Pages/Dashboard');
        }
    }

    public function aboutUs()
    {
        $this->pageTitle = 'About Page';

        // $clients = Client::where('status',2)->orWhere(function($query){
        //     $query->where('status',3)
        //     ->where('publish_time','<=',date('Y-m-d h:i:s'));
        // })->get();
        $companyInfo = CompanyInformation::first();
        // $sectionImages = SectionImage::where('status',2)->get();
        $data = [
            // 'clients' => $clients,
            'companyInfo' => $companyInfo,
            // 'sectionImages' => $sectionImages,
            'pageTitle' => $this->pageTitle,
        ];
        return Inertia::render('Guest/Pages/About', $data);
    }

    public function footerData(){
        $companyInfo = CompanyInformation::first();
        $socialMedias = SocialMedia::where('status',2)->get();
        // $solutions = Solution::where('status',2)->orWhere(function($query){
        //     $query->where('status',3)
        //     ->where('publish_time','<=',date('Y-m-d h:i:s'));
        // })->get();
        $data = [
            'companyInfo' => $companyInfo,
            // 'solutions' => $solutions,
            'socialMedias' => $socialMedias,
        ];
        return $data;
    }

    public function topBarData()
    {
        $companyInfo = CompanyInformation::first();
        $socialMedias = SocialMedia::where('status',2)->get();
        $data = [
            'companyInfo' => $companyInfo,
            'socialMedias' => $socialMedias,
        ];
        return $data;
    }

    public function test()
    {
        $data = [
            'title'=>'Home'
        ];
        return Inertia::render('Admin/Pages/Dashboard', $data);
    }
}
