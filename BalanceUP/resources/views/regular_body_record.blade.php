@extends('app')
@section('title', 'からだの記録')
@section('content')

<script>
   function validateForm() {
           var h = document.forms["playInfo"]["height"].value;
           var w = document.forms["playInfo"]["weight"].value;
           if (h == "") {
               alert("身長の値を入力してください");
               return false;
           }

           if (w == "") {
               alert("体重の値を入力してください");
               return false;
           }
   }
</script>

<!--begin::Container-->
<div class="container">
   <!--begin::Dashboard-->
   <!--begin::Row-->
   <div class="row">
      <div class="col-xl-12">
         <!--begin::Tiles Widget 1-->
         <div class="card card-custom gutter-b card-stretch">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
               <div class="card-title">
               </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body d-flex flex-column px-0" style="text-align: center; min-height:400px">
               <div class="col-lg-12 col-md-12 content-item content-item-1 background border-radius20"
                  style="padding: 20px;position: relative;">
                  <!-- <div>
                        <p class="headBtn">アカウント作成</p>
                     </div>  -->
                  <form class="form__wrapper" name="playInfo" method="POST"
                     action="{{url('/input-regular-body-record')}}" onsubmit="return validateForm()">
                     @csrf
                     <div class="row m-container">
                        <div class="col-md-6 sub-input">
                           <span id="td-title">身長</span>
                           <input class="form-control" type="text" name="height">
                           <span>cm</span>
                        </div>
                        <div class="col-md-6 sub-input">
                           <span id="td-title">体重</span>
                           <input class="form-control" type="text" name="weight">
                           <span>kg</span>
                        </div>
                        <div class="col-md-6 sub-input">
                           <span id="td-title">体脂肪率</span>
                           <input class="form-control" type="text" name="fat">
                           <span>%</span>
                        </div>
                        <div class="col-md-6 sub-input">
                           <span id="td-title">筋肉量</span>
                           <input class="form-control" type="text" name="muscle">
                           <span>kg</span>
                        </div>
                        <div class="col-md-6 sub-input">
                           <span id="td-title">練習頻度</span>
                           <input class="form-control" type="text" name="frequency">
                           <span>回/週</span>
                        </div>
                        <div class="col-md-6 sub-input">
                           <span id="td-title">練習時間</span>
                           <input class="form-control" type="text" name="time">
                           <span>時間/週</span>
                        </div>
                        <div class="col-md-12 form-next-btn">
                           <button type="submit" id="submit" style="display: none;"></button>
                           <a class="nextBtn" href="javascript: $('#submit').click();">次へ</a>
                        </div>
                     </div>
                  </form>
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