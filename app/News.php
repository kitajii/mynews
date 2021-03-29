<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //
    protected $guarded = array('id'); //idは自動割り当てなのでユーザーからの入力は不要。
    
    public static $rules = array(
        'title' => 'required',
        'body' => 'required', //requiredは必須項目。空だとエラーに。
    );
        
    public function histories() {
      return $this->hasMany('App\History'); //newsテーブルに関連付いているhistoriesテーブルをすべて取得するというメソッド。１対多。
    }
}
