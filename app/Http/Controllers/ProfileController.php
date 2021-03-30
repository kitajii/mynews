<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;
use App\Profile;

// 閲覧者用のプロフィール表示ページのController

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $posts = Profile::all()->sortByDesc('updated_at');
        
        if(count($posts) > 0){
            $new_user = $posts->shift();
        }else{
            $new_user = null;
        }
        
        return view('profile.index', ['new_user' => $new_user, 'posts'=>$posts]);
    }
}
