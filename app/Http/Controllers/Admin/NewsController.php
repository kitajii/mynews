<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    // 以下を追記
    public function add() { //フォーム送信していない状態の表示？
        return view('admin.news.create');
    }
    public function create(Request $request) { //useで使用する事を宣言しているRequestというクラス
      // admin/news/createにリダイレクトする
      return redirect('admin/news/create');
    }
}
