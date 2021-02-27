@extends('app')
@section('title', '先頭ページ')
@section('content')
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/playerList.js')}}"></script>

<!--begin::Container-->
<div class="container">
   <!--begin::Dashboard-->
   <!--begin::Row-->
   <div class="row">
      <div class="col-xl-12">
         <!--begin::Tiles Widget 1-->
         <div class="card card-custom gutter-b card-stretch" id="kt_page_stretched_card">
            <!--begin::Body-->
            <div class="card-body d-flex flex-column px-0" style="text-align: center; min-height:400px">
               <div class="row col-md-12">
                  <a href="/outputCSV" class="headBtn col-sm-2"
                     style="border-style: solid solid solid solid; margin-left: 3%">CSV出力へ</a>
               </div>
               <div class="card-scroll col-md-10" id="staffinfo" style="font-size:18px; margin-top: 50px">
                  <div class="container">
                     <table id="table-id" class="table table-bordered gridview">
                        <thead>
                           <tr>
                              <th>ユーザーID</th>
                              <th>食事チェック結果</th>
                              <th>からだの変化</th>
                           </tr>
                        </thead>
                        <tbody>
                           @isset($playerlist)
                           @foreach($playerlist as $value)
                           <tr>
                              <td> {{ $value->userid }} </td>
                              <td><a href="{{url('/result/'.$value->userid)}}">食事チェック結果</a></td>
                              <td><a href="{{url('/view-body-graph/'.$value->userid)}}">からだの変化</a></td>
                           </tr>
                           @endforeach
                           @endisset
                        </tbody>
                     </table>
                     <div style="text-align: right;padding-right: 100px;margin-top: 30px;">
                        <div>
                           <a href="{{url('/staff-page')}}"><span class="btn btn-primary btn-lg"
                                 style="border-radius: 5px; min-width: 100px">戻る</span></a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!--end::Body-->
         </div>
         <!--end::Tiles Widget 1-->
      </div>
   </div>
   <!--end::Row-->
   <!--end::Dashboard-->
</div>
<!--end::Container-->

@stop