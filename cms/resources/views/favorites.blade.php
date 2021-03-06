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
                        店舗一覧
                    </thead>
                    <!-- テーブル店舗体 -->
                    <tbody>
                         @foreach ($shops as $shop)
                            <tr>
                                <!-- 店舗名 -->
                                <td class="table-text">
                                    <div>{{ $shop->shop_name }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $shop->formatted_address }}</div>
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

                                <!-- 詳細ボタン -->
                                <td>
                                    <form action="{{ url('detail/'.$shop->place_id) }}" method="get">
                                       {{ csrf_field() }}
                                        <button type="submit" class="btn btn-primary">
                                            <i class="glyphicon glyphicon-pencil"></i> 詳細
                                        </button>
                                    </form>
                                </td>
                            </tr>
                         @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3 center">
                        {{$shops->links()}}
                    </div>
                </div>
                
 
            </div>
         </div>
     @else
     <div class="container">
        <div class="row card favorite-card">
            <div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3 ">
                <div class ="card_shop_name">お気に入り店舗が登録されていません</div>
                <hr class="card_hr">
                <div class="hight"><a href="{{'/'}}">店舗を検索</a></div>
            </div>
        </div>
</div>
     @endif
 @endsection
 

