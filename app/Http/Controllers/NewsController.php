<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;
use App\News;

// 閲覧者用の記事表示ページのController

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $posts = News::all()->sortByDesc('updated_at'); //Newsモデルのテーブルを全取得。更新が新しい順に表示。
        
        //記事があれば最新記事を$headlineに入れる
        if (count($posts) > 0) {
            $headline = $posts->shift(); //shiftで$postsのkeyが0のものだけ$headlineに移動させる。
        } else {
            $headline = null; 
        }
        // news/index.blade.php ファイルを渡している
        // また View テンプレートに headline、 posts、という変数を渡している
        return view('news.index', ['headline' => $headline, 'posts' => $posts]);
    }
}