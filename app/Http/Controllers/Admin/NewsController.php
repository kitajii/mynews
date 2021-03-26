<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;

class NewsController extends Controller
{
    
    //フォーム送信前の記事作成画面表示アクション
    public function add() {
        return view('admin.news.create');
    }
    
    //記事作成フォーム送信時アクション（バリデーション＋データ保存）
    public function create(Request $request) { //useで使用する事を宣言しているRequestというクラスのインスタンスを作っている。つまりRequestが持つ機能を引き継いでいる。
        $this->validate($request, News::$rules); //Requestが持つvalidateメソッドは、$requestの値を$rulesに参照して正しい内容か検査する。
        $news = new News; //News.phpのNewsクラスのインスタンスを$newsに格納
        $form = $request->all(); // 全リクエストデータを連想配列で取得し、$formに格納
        
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image'); //$pathに"public/image/ファイル名"という文字列が代入される
            $news->image_path = basename($path); //basename()は引数のファイル名の部分のみを渡す
        }else{
            $news->image_path = null;
        }
        
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する(image_pathに保存されてる)
        unset($form['image']);
        
        // データベースに保存する
        $news->fill($form); //fill($form ※配列)で、Schema::createで作成したカラムと一致する$formの値を代入してくれる。
        $news->save(); //save()が呼び出されると、データベースに新しいレコードが挿入される。
        
        return redirect('admin/news/create');
    }

    //記事検索＋一覧画面表示アクション
    public function index(Request $request) { //一覧表示と検索機能のアクション
        $cond_title = $request->cond_title; //cond_titleは検索された値
        if($cond_title != '') {
            $posts = News::where('title',$cond_title)->get(); //newsテーブルの中のtitleカラムで$cond_title（ユーザーが入力した文字）に一致するレコードをすべて取得する
        } else {
            $posts = News::all(); //cond_titleがnullの時、newsテーブルのレコードを全て$postに代入
        }
        return view('admin.news.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
    //記事編集画面表示アクション
    public function edit(Request $request){
        $news = News::find($request->id); //find...->id)で該当するidのレコードを丸々配列にして渡す。
        if(empty($news)){
            abort(404);
        }
        return view('admin.news.edit',['news_form' => $news]);
    }
    
    //記事編集フォーム送信時アクション
    public function update(Request $request){
        $this->validate($request, News::$rules); //記事作成時と同じくバリデーションをかける
        $news = News::find($request->id); //Newsモデルからidが一致する記事データを取得
        $news_form = $request->all(); //更新する各データを$news_formに格納する
        //画像の変更
        if($request->remove == 'true'){
            $news_form['image_path'] = null;
        }elseif($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $news_form['image_path'] = basename($path);
        }else{
            $news_form['image_path'] = $news->image_path;
        }
        unset($news_form['image']);
        unset($news_form['remove']);
        unset($news_form['_token']);
        
        $news->fill($news_form)->save();
        return redirect('admin/news');
    }
    //記事の削除アクション
    public function delete(Request $request){
        $news = news::find($request->id);
        
        $news->delete();
        return redirect('admin/news/');
    }
}
