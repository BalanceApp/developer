@extends('app')
@section('title', '毎日の記録')
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
            <!--begin::Body-->
            <div class="card-body d-flex flex-column px-0" style="text-align: center; min-height:400px">
               <div class="col-lg-12 col-md-12 content-item content-item-1 background border-radius20"
                  style="padding: 20px;position: relative;">
                  <div>
                     <h1 class="headBtn">毎日の記録</h1>
                  </div>
                  <form method="POST" action='/input-daily-body-record' class="form__wrapper" name="playInfo"
                     onsubmit="return validateForm()">
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
                        <div class="col-md-12 form-next-btn">
                           <button type="submit" id="submit" style="display: none;"></button>
                           <a class="nextBtn" href="javascript: $('#submit').click();"
                              style="margin-top: 100px">入力完了</a>
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

@stop