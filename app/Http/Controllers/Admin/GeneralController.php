<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class GeneralController extends Controller
{
    public function __construct(){
        $this->middleware('gen-auth');
        $this->middleware('admin-auth')->only('dashboard');
    }
    public function dashboard(){
        return Inertia::render('Admin/Pages/Dashboard');
    }
    public function statistics(){
        if ((Auth::user()->user_category != 100)) {
            $totalViews = Post::where('user_id', Auth::user()->id)
            ->sum('views');
        } else {
            $totalViews = Post::sum('views');
        }
        
        $statistics = [
            'totalViews' => $totalViews,
        ];
        return $statistics;
    }
}
