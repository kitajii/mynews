<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;

class NewsController extends Controller
{
    // 以下を追記
    public function add() { //フォーム送信していない状態の表示？
        return view('admin.news.create');
    }
    public function create(Request $request) { //useで使用する事を宣言しているRequestというクラスのインスタンスを作っている。つまりRequestが持つ機能を引き継いでいる。
        $this->validate($request, News::$rules); //validateメソッドは、
        $news = new News; //News.phpのNewsクラスのインスタンスを作成
        $form = $request->all(); // 全リクエストデータを連想配列で取得し、$formに格納
        
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image'); //$pathに"public/image/ファイル名"という文字列が代入される
            $news->image_path = basename($path); //basename()は引数のファイル名の部分のみを渡す
        }else{
            $news->image_path = null;
        }
        
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する(もうpublic/imageに保存したからいらない)
        unset($form['image']);
        
        // データベースに保存する
        $news->fill($form); //fill($form ※配列)で、Schema::createで作成したカラムと一致する$formの値を代入してくれる。
        $news->save(); //save()が呼び出されると、データベースに新しいレコードが挿入される。
        
        return redirect('admin/news/create');
    }
}
