@extends('layouts.front')

@section('title' , 'プロフィール一覧')

@section('content')
    <div class="container">
        <hr color="#c0c0c0">
        @if (!is_null($new_user))
            <div class="row">
                <div class="new_user col-md-10 mx-auto">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="caption mx-auto">
                                <div class="name p-2">
                                    <h2>{{ str_limit($new_user->name, 70) }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p class="text-right">最新のユーザー</p>
                        </div>
                        <div class="col-md-12">
                            <p class="gender mx-auto px-2">性別：{{ str_limit($new_user->gender, 650) }}</p>
                        </div>
                        <div class="col-md-12">
                            <p class="hobby mx-auto px-2">趣味：{{ str_limit($new_user->hobby, 650) }}</p>
                        </div>
                        <div class="col-md-12">
                            <p class="introduction mx-auto px-2">自己紹介：{{ str_limit($new_user->introduction, 650) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <hr color="#c0c0c0">
        <div class="row">
            <div class="posts col-md-10 mx-auto mt-3">
                @foreach($posts as $post)
                    <div class="post">
                        <div class="row">
                            <div class="text col-md-6">
                                <div class="date">
                                    {{ $post->updated_at->format('Y年m月d日') }}
                                </div>
                                <div class="name">
                                    {{ str_limit($post->name, 150) }}
                                </div>
                                <div class="gender mt-3">
                                    {{ str_limit($post->gender, 1500) }}
                                </div>
                                <div class="hobby mt-3">
                                    {{ str_limit($post->hobby, 1500) }}
                                </div>
                                <div class="introduction mt-3">
                                    {{ str_limit($post->introduction, 1500) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr color="#c0c0c0">
                @endforeach
            </div>
        </div>
    </div>
@endsection