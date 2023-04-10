<?php

namespace App\Http\Controllers;

use App\Models\Admin\Qoute;
use App\Models\Enquiry;
use App\Models\Post\Category;
use App\Models\Post\Comment;
use App\Models\Post\Post;
use App\Models\Post\Reply;
use App\Traits\Admin\LayoutTrait;
use App\Models\Post\SubCategory;
use App\Models\Subscribe;
use App\Models\System\AdminUser;
use App\Models\System\Advert;
use App\Models\System\CompanyInformation;
use App\Models\System\Product;
use App\Models\System\SocialMedia;
use App\Models\System\UserRole;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Illuminate\Support\Str;

class GeneralContoller extends Controller
{

    use LayoutTrait;

    // public $pageTitle ='';
    public function __construct(){
        $this->middleware('gen-auth')->only('dashboard');
    }

    public function home()
    {
        $posts = Post::with(['categories', 'user'])
        ->where('visibility',1)
        ->where('status',2)
        ->orWhere(function($query){
            $query->where('status',3)
            ->where('publish_time','<=',date('Y-m-d h:i:s'));
        })
        ->latest()
        ->paginate(6);
        
        // info($posts);
        // $posts = App\Post::orderBy('views', 'desc')->take(9)->get();

        $popularPosts = Post::with(['categories', 'user'])
        ->orderBy('views', 'desc')            
        ->where('status',2)
            ->orWhere(function($query){
                $query->where('status',3)
                ->where('publish_time','<=',date('Y-m-d h:i:s'));
            })
            ->take(9)->get();
        $adverts = Advert::where('status',2)
            ->orWhere(function($query){
                $query->where('status',3)
                ->where('publish_time','<=',date('Y-m-d h:i:s'));
            })
        ->take(3)->get();
        $qoutes = Qoute::where('status',2)
            ->orWhere(function($query){
                $query->where('status',3)
                ->where('publish_time','<=',date('Y-m-d h:i:s'));
            })
        ->latest()
        ->take(6)->get();

        $companyInfo = CompanyInformation::first();
        $data = [
            'posts' => $posts,
            'companyInfo' => $companyInfo,
            'adverts' => $adverts,
            'popularPosts' => $popularPosts,
            'qoutes' => $qoutes,
        ];
        return Inertia::render('Guest/Pages/Home', $data);
    }
    public function browseSubcategory($title, $sub_title) {

        // info($title .'&' .$sub_title);
        // dd ($title .'&' .$sub_title);
        $sub_title = str_replace('-',' ',$sub_title);
        $subcategory = SubCategory::with('categories')
        ->whereRaw('LOWER(`title`) LIKE ? ',$sub_title)
        ->where('status',2)->orWhere(function($query){
            $query->where('status',3)
            ->where('publish_time','<=',date('Y-m-d h:i:s'));
        })->first();
        if($subcategory == null){
            return redirect()->route('home');
        }

        $posts = Post::whereHas('sub_categories', function(Builder $query) use($subcategory)  {
            $query->where('sub_category_id',  $subcategory->id);
        })
        ->with(['sub_categories' => function($query) use($subcategory) {
            $query->where('sub_category_id',  $subcategory->id);
        }, 'user'])

        ->where('status',2)
        ->orWhere(function($query){
            $query->where('status',3)
            ->where('publish_time','<=',date('Y-m-d h:i:s'));
        })
        ->paginate(6);
        
        $popularPosts = Post::with(['categories', 'user'])
        ->orderBy('views', 'desc')
        ->where('views', '>',1)            
        ->where('status',2)
            ->orWhere(function($query){
                $query->where('status',3)
                ->where('publish_time','<=',date('Y-m-d h:i:s'));
            })
        ->take(9)->get();
        $adverts = Advert::where('status',2)
            ->orWhere(function($query){
                $query->where('status',3)
                ->where('publish_time','<=',date('Y-m-d h:i:s'));
            })
        ->take(3)->get();
        $data = [
            'posts' => $posts,
            'adverts' => $adverts,
            'popularPosts' => $popularPosts,
            'subcategories' =>'',
            'category' => $subcategory,
        ];
        return Inertia::render('Guest/Pages/Browse', $data);
    }

    public function browse($title)
    {
        $title = str_replace('-',' ',$title);
        $category = Category::with('sub_categories')
        ->whereRaw('LOWER(`title`) LIKE ? ',$title)
        ->where('status',2)->orWhere(function($query){
            $query->where('status',3)
            ->where('publish_time','<=',date('Y-m-d h:i:s'));
        })->first();
        if($category == null){
            return redirect()->route('home');
        }

        // $subcategories = SubCategory::whereHas('categories', function(Builder $query) use ($category) {
        //     $query->where('category_id',  $category->id);
        // })
        // ->where('status',2)
        // ->orWhere(function($query){
        //     $query->where('status',3)
        //     ->where('publish_time','<=',date('Y-m-d h:i:s'));
        // })
        // ->get();

        $posts = Post::whereHas('categories', function(Builder $query) use($category)  {
            $query->where('category_id',  $category->id);
        })
        ->with(['categories' => function($query) use($category) {
            $query->where('category_id',  $category->id);
        }, 'user'])

        ->where('status',2)
        ->orWhere(function($query){
            $query->where('status',3)
            ->where('publish_time','<=',date('Y-m-d h:i:s'));
        })
        ->paginate(6);
        $popularPosts = Post::with(['categories', 'user'])
        ->where('views', '>',1)
        ->orderBy('views', 'desc')            
        ->where('status',2)
            ->orWhere(function($query){
                $query->where('status',3)
                ->where('publish_time','<=',date('Y-m-d h:i:s'));
            })
            ->take(9)->get();
        $adverts = Advert::where('status',2)
            ->orWhere(function($query){
                $query->where('status',3)
                ->where('publish_time','<=',date('Y-m-d h:i:s'));
            })
        ->take(3)->get();

        $data = [
            'posts' => $posts,
            'adverts' => $adverts,
            'popularPosts' => $popularPosts,
            'subcategories' => $category->sub_categories,
            'category' => $category,
        ];
        return Inertia::render('Guest/Pages/Browse', $data);
    }

    public function post($title)
    {
        $urlTitle = $title;
        $title = str_replace('-',' ',$title);
        // $title = str_replace(':',' ',$title);
        // info($title);
        $cardData = Post::with(['categories', 'user', 'meta', 'tags'])
        ->whereRaw('LOWER(`title`) LIKE ? ',$title)
        ->where('status',2)->orWhere(function($query){
            $query->where('status',3)
            ->where('publish_time','<=',date('Y-m-d h:i:s'));
        })->first();

        if (!$cardData) {
            return redirect()->route('home');
        }
        Post::where('id', $cardData->id)
        ->update(['views' => $cardData->views +1]);
        $relatedPosts = [];
        $all_objects = collect(); // create an empty Collection object
        // info($cardData->categories);
        foreach ($cardData->categories as $key => $category) {
            $relatedPost = Post::with(['categories', 'user'], function(Builder $query) use ($category) {
                $query->where('category_id',  $category->id);
            })
            ->where('status',2)
            ->where('id', '!=', $cardData->id)
            ->orWhere(function($query){
                $query->where('status',3)
                ->where('publish_time','<=',date('Y-m-d h:i:s'));
            })
            // ->inRandomOrder()->limit(2)
            ->get();
            // ->toArray();
            // info($relatedPost);
            $all_objects = $all_objects->merge($relatedPost);
            // array_merge($relatedPosts, $relatedPost);
            // array_push($relatedPosts, $relatedPost);
        }
        $popularPosts = Post::with(['categories', 'user'])
        ->where('views', '>',1)
        ->orderBy('views', 'desc')            
        ->where('status',2)
            ->orWhere(function($query){
                $query->where('status',3)
                ->where('publish_time','<=',date('Y-m-d h:i:s'));
            })
            ->take(3)->get();
        $adverts = Advert::where('status',2)
            ->orWhere(function($query){
                $query->where('status',3)
                ->where('publish_time','<=',date('Y-m-d h:i:s'));
            })
        ->take(3)->get();
        $companyInfo = CompanyInformation::first();
        
        // info($adverts->toArray());
        $data = [
            'cardData' => $cardData,
            'title' => $urlTitle,
            'pageTitle' => '',
            'adverts' => $adverts->toArray(),
            'popularPosts' => $popularPosts,
            'companyInfo' => $companyInfo,
            'relatedPosts' => $all_objects,
        ];
        return Inertia::render('Guest/Pages/Show', $data);
    }

    public function dislike(Request $request)
    {
        $this->validate($request, [
            'uuid' => 'required',
            'dislikes' => 'required',
        ]);
    
        $ip_address = $this->get_ip_address();
        $mac_address = $this->get_mac_address();
       
        if (Session::get('ip_address_d') == $ip_address && Session::get('mac_address_d') == $mac_address && Session::get('uuid_d') == $request->uuid) {

            $post = Post::where('uuid', $request->uuid)->first();
            return response()->json([
                'message' => 'Already disliked',
                'dislikes' => $post->dislikes,
                'ip_address' => $ip_address,
                'mac_address' => $mac_address,
            ], 201);
        }
        DB::beginTransaction();
        try {
            $post = Post::where('uuid', $request->uuid)
            ->update(['dislikes' => intVal($request->dislikes)]);
            
            DB::commit();
            Session::put('ip_address_d', $ip_address);
            Session::put('mac_address_d', $mac_address);
            Session::put('uuid_d', $request->uuid);

            $response = $this->notification('success');
            $post = Post::where('uuid', $request->uuid)->first();
            return response()->json([
                'message' => 'Success',
                'dislikes' => $post->dislikes,
                'ip_address' => $ip_address,
                'mac_address' => $mac_address,
            ], 201);
            return response()->json($response,200);
            return response()->json(['message' => 'User created'], 201);
           
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e);
            $response = $this->notification('error');
            return response()->json([
                'error' => $e->getMessage(),
                'likes' => $post->likes,
                'ip_address' => $ip_address,
                'mac_address' => $mac_address,
            ], 500);
            return response()->json($response,500);
            return back()->with('flash', [
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
            return response()->json(['errors' => $e->getMessage()], 422);
            
        }
        return response()->json(['message' => 'User created'], 201);
    }
    public function like(Request $request)
    {
        $this->validate($request, [
            'uuid' => 'required',
            'likes' => 'required',
        ]);
        // info("UUID:" .$request->uuid);
        // dd($request->uuid);
        $ip_address = $this->get_ip_address();
        $mac_address = $this->get_mac_address();
       
        if (Session::get('ip_address_l') == $ip_address && Session::get('mac_address_l') == $mac_address && Session::get('uuid_l') == $request->uuid) {

            $post = Post::where('uuid', $request->uuid)->first();
            return response()->json([
                'message' => 'Already liked',
                'likes' => $post->likes,
                'ip_address' => $ip_address,
                'mac_address' => $mac_address,
            ], 201);
        }
       
        DB::beginTransaction();
        try {
            
            $post = Post::where('uuid', $request->uuid)
            ->update(['likes' => intval($request->likes) ]);
            DB::commit();
            $post = Post::where('uuid', $request->uuid)->first();
            Session::put('ip_address_l', $ip_address);
            Session::put('mac_address_l', $mac_address);
            Session::put('uuid_l', $request->uuid);
             
            $response = $this->notification('success');
            
            return response()->json([
                'message' => 'Success',
                'likes' => $post->likes,
                'ip_address' => $ip_address,
                'mac_address' => $mac_address,
            ], 201);
            $response = $this->notification('success');
            return response()->json($response,200);
            return response()->json(['message' => 'User created'], 201);
           
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e);
            $response = $this->notification('error');
            return response()->json([
                'error' => $e->getMessage(),
                'likes' => $post->likes,
                'ip_address' => $ip_address,
                'mac_address' => $mac_address,
            ], 500);
            // return response()->json($response,500);
            // return back()->with('flash', [
            //     'type' => 'error',
            //     'message' => $e->getMessage(),
            // ]);
            return response()->json(['errors' => $e->getMessage()], 422);
            
        }
        return response()->json(['message' => 'User created'], 201);
    }
    public function comments($uuid)
    {
        $post =  Post::where('uuid', $uuid)->first();
        $comments = Comment::with(['post', 'replies'])
        ->where('post_id', $post->id)
        ->where('status',1)->orWhere(function($query){
            $query->where('status',3)
            ->where('publish_time','<=',date('Y-m-d h:i:s'));
        })->latest()->get();
        $data = [
            'comments' => $comments,
        ];
        return $data;
    }
    public function comment(Request $request)
    {
        $this->validate($request, [
            'uuid' => 'required',
            'content' => 'required',
        ]);
        $post =  Post::where('uuid', $request->uuid)->first();
        DB::beginTransaction();
        try {
            Comment::create([
                'uuid' => (string) Str::uuid(),
                'content' => $request->content,
                'post_id' => $post->id,
                'name' => $request->name? $request->name : uniqid('User_'),
                'email' =>$request->email,
                'visibility' =>1,
                'status' =>1,
            ]); 
            DB::commit();
            $comments = Comment::with(['post', 'replies'])
            ->where('post_id', $post->id)
            ->where('status',1)->orWhere(function($query){
                $query->where('status',3)
                ->where('publish_time','<=',date('Y-m-d h:i:s'));
            })->get();
            $data = [
                'comments' => $comments,
                'success' => config('app.defaultErrors.crud.created')
            ];
            return $data;

        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th);
            return ['error' => config('app.defaultErrors.default')];
            return response()->json([
                'error' => $th->getMessage(),
            ], 500);
        }
        
        
    }
    public function reply(Request $request)
    {
        // info('arrived');
        $this->validate($request, [
            'content' => 'required',
            'post_uuid' => 'required',
            'comment_id' => 'required',
        ]);
        $post = Post::where('uuid', $request->post_uuid)->first();
        $comment =  Comment::where('id', $request->comment_id)->first();
        DB::beginTransaction();
        try {
            Reply::create([
                'uuid' => (string) Str::uuid(),
                'content' => $request->content,
                'comment_id' => $comment->id,
                'reply_to_id' => $request->reply_to_id,
                'name' => $request->name? $request->name : uniqid('User_'),
                'email' =>$request->email,
                'visibility' =>1,
                'status' =>1,
            ]); 
            DB::commit();
            $comments = Comment::with(['post', 'replies'])
            ->where('post_id', $post->id)
            ->where('status',1)->orWhere(function($query){
                $query->where('status',3)
                ->where('publish_time','<=',date('Y-m-d h:i:s'));
            })->get();
            $data = [
                'comments' => $comments,
                'success' => config('app.defaultErrors.crud.created')
            ];
            return $data;

        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e);
            return ['error' => config('app.defaultErrors.default')];
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
        
        
    }
    public function dashboard()
    {
        if (Auth::user()->status == 1) {
            Auth::logout();
            return Inertia::render('Guest/Auth/Login', [
                'error' => 'Oops! your account has been suspended. Kindly consult the management',
            ]);
            return redirect('/login')->with('error','Oops! your account has been suspended. Kindly consult the management');
        }
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
           
            return Inertia::render('Admin/Pages/Dashboard');
        }
    }

    public function aboutUs()
    {
        $companyInfo = CompanyInformation::first();
        $socialMedias = SocialMedia::where('status',2)->orWhere(function($query){
            $query->where('status',3)
            ->where('publish_time','<=',date('Y-m-d h:i:s'));
        })->get();
        $qoutes = Qoute::where('status',2)->orWhere(function($query){
            $query->where('status',3)
            ->where('publish_time','<=',date('Y-m-d h:i:s'));
        })->latest()->get();
        $data = [
            'companyInfo' => $companyInfo,
            'socialMedias' => $socialMedias,
            'qoutes' => $qoutes,
            'pageTitle' => 'About Us',
        ];
        return Inertia::render('Guest/Pages/About', $data);
    }
    public function contact()
    {
               
        $companyInfo = CompanyInformation::first();
        $socialMedias = SocialMedia::where('status',2)->orWhere(function($query){
            $query->where('status',3)
            ->where('publish_time','<=',date('Y-m-d h:i:s'));
        })->get();
        $qoutes = Qoute::where('status',2)->orWhere(function($query){
            $query->where('status',3)
            ->where('publish_time','<=',date('Y-m-d h:i:s'));
        })->latest()->get();
        $data = [
            'companyInfo' => $companyInfo,
            'socialMedias' => $socialMedias,
            'qoutes' => $qoutes,
            'pageTitle' => 'Contact Us',
        ];
        return Inertia::render('Guest/Pages/Contact', $data);
    }
    public function get_ip_address(){
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public function get_mac_address()
    {
        return exec('getmac');
    }
    public function footerData(){
        $companyInfo = CompanyInformation::first();
        $socialMedias = SocialMedia::where('status',2)->get();
        $products = Product::where('status',2)->orWhere(function($query){
            $query->where('status',3)
            ->where('publish_time','<=',date('Y-m-d h:i:s'));
        })->get();
        $data = [
            'companyInfo' => $companyInfo,
            'products' => $products,
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
    public function categories(){
       
        $categories = Category::where('status',2)->orWhere(function($query){
            $query->where('status',3)
            ->where('publish_time','<=',date('Y-m-d h:i:s'));
        })->get();
        $data = [
            'categories' => $categories,
        ];
        return $data;
    }

    public function subscribe(REQUEST $request){
        // info($request->email);
        $this->validate($request, [
            'email' => 'required|email',
        ]);
    
        DB::beginTransaction();
        try {
            Subscribe::create([
                'uuid' => (string) Str::uuid(),
                'email' => $request->email,
            ]);
            DB::commit();
            sleep(3);
            $response = $this->notification('success');
            return back()->with('flash', [
                'type' => 'success',
                'message' => 'Succesfully Submitted',
            ]);
            
            return response()->json([
                'message' => 'Thank you for subscribing! We promise not to spam you or share your email whatsoever'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e);
            return back()->with('flash', [
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
            return response()->json(['errors' => $e->getMessage()], 422);
            
        }
    }
    public function sendMessage(REQUEST $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required|max:255',
            'phone' => 'required|min:8',
        ]);
       
        $record = [
            'name' => $request->name,
            'email' => $request->email,
            'inquiry' => $request->message,
            'phone_no' => $request->phone,
            'created_by' => $request->email,
        ];
        DB::beginTransaction();
        try {
            Enquiry::updateOrCreate(["uuid" => $this->pKey], $record);
            DB::commit();
            $response = $this->notification('generalSuccess');

            // return redirect('/')->with($response);
            return back()->with($response);
            return back()->with($response);
            return response()->json($response,200);
            // return redirect('/')->with($response);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e);
            return back()->with('flash', [
                'message' => 'error',
            ]);
            return back()->with( [
                'type' => 'error',
                'message' => 'Oops! Something went wrong. Please try again',
            ]);
            return response()->json($response,500);
        }
    }

    public function test()
    {
        $data = [
            'title'=>'Home'
        ];
        return Inertia::render('Admin/Pages/Dashboard', $data);
    }
}
