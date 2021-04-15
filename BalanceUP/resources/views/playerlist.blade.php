@extends('app')
@section('title', '先頭ページ')
@section('content')
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/playerList.js')}}"></script>

<div class="container">
   <div class="row">
      <div class="col-xl-12">
         <div class="card card-custom gutter-b card-stretch" id="kt_page_stretched_card">
            <div class="card-body d-flex flex-column px-0">
               <div class="row">
                  <div class="col-2 ml-6">
                     <a href="/outputCSV" class="headBtn" style="border-style: solid solid solid solid;">CSV出力へ</a>
                  </div>
               </div>
               <div class="row mt-10">
                  <div class="col-11 mx-auto">
                     <table id="table-id" class="table table-bordered gridview">
                        <thead>
                           <tr>
                              <th>ユーザーID</th>
                              <th>氏名</th>
                              <th>チーム名</th>
                              <th>食事チェック結果</th>
                              <th>からだの変化</th>
                           </tr>
                        </thead>
                        <tbody>
                           @isset($playerlist)
                           @foreach($playerlist as $value)
                           <tr>
                              <td> {{ $value->userid }} </td>
                              <td> {{ $value->name }} </td>
                              <td> {{ $value->team }} </td>
                              <td><a href="{{url('/result/'.$value->userid)}}">食事チェック結果</a></td>
                              <td><a href="{{url('/view-body-graph/'.$value->userid)}}">からだの変化</a></td>
                           </tr>
                           @endforeach
                           @endisset
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="row mt-10 mr-13">
                  <div class="col-12">
                     <a href="{{url('/staff-page')}}" class="float-right"><span class="btn btn-primary btn-lg">戻る</span></a>
                  </div>
               </div>
            </div>
         </div>
      </div>

      @stop