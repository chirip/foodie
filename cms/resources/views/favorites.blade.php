<!-- resources/views/favorites.blade.php -->

@extends('layouts.app')
@section('content')
     <!-- 現在 店舗 -->
     @if (count($shops) >0 )
         <div class="panel panel-default">
                <div class="panel-heading"> 
                    お気に入り店舗
                </div>
                <div class="panel-body">
                <table class="table table-striped task-table">
                    <!-- テーブルヘッダ -->
                    <thead>
                        <th>店舗一覧</th>
                        <th>&nbsp;</th>
                    </thead>
                    <!-- テーブル店舗体 -->
                    <tbody>
                         @foreach ($shops as $shop)
                            <tr>
                                <!-- 店舗名 -->
                                <td class="table-text">
                                    <div>{{ $shop->id }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $shop->shop_name }}</div>
                                </td>
                                
                                <!-- 削除ボタン -->
                                <td>
                                    <form action="{{ url('favorites/delete/'.$shop->id) }}" method="POST">
                                       {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger">
                                            <i class="glyphicon glyphicon-trash"></i> 削除
                                        </button>
                                    </form>
                                </td>
                            </tr>
                         @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        {{$shops->links()}}
                    </div>
                </div>
                
 
            </div>
         </div>
     @else
         <div>
             <p>お気に入り店舗が登録されていません。</p>
             <a href="http://base5-5-debugbar-cloned-hashimotogs.c9users.io/">店舗を検索</a>
         </div>
     
     @endif
 @endsection
 

