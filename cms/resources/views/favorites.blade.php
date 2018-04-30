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
                                <!-- 店舗タイトル -->
                                <td class="table-text">
                                    <div>{{ $shop->id }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $shop->shop_name }}</div>
                                </td>
                                
                                <!-- 本: 削除ボタン -->
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
                
 
            </div>
         </div>
     @else
     @endif