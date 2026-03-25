@extends('includes.master')
@section('headerscript')
@parent
<style>
    .header{
        display:none;
    }
    .back-to-top{
        display : none;
    }
    #footer-bar {
        display:none;
    }
    .footer-card{
        bottom : 0px !important;
    }
</style>
@endsection

@section('header')
@parent
@endsection

@section('content')

<div class="page-title page-title-small ">
    
</div>

<div class="card header-card shape-rounded" data-card-height="150">
    <div class="card-overlay bg-highlight opacity-95"></div>
    <div class="card-overlay dark-mode-tint"></div>
    
    <div class="card-bg preload-img" data-src=""></div>
</div>
@if(Session::has('success'))
<div class="ms-3 me-3 alert alert-small rounded-s shadow-xl bg-green-dark s-alrt" role="alert">
    <span><i class="fa fa-check"></i></span>
    <strong>{{ Session::get('success') }}</strong>
    <button type="button" class="close color-white opacity-60 font-16" data-bs-dismiss="alert" aria-label="Close">&times;</button>
</div>
@endif

@if(Session::has('error'))
<div class="ms-3 me-3 mb-5 alert alert-small rounded-s shadow-xl bg-red-dark s-alrt" role="alert">
    <span><i class="fa fa-times"></i></span>
    <strong>{{ Session::get('error') }}</strong>
    <button type="button" class="close color-white opacity-60 font-16" data-bs-dismiss="alert" aria-label="Close">&times;</button>
</div>
@endif

<div class="card card-style">
    <div class="content">
        <div class="col-12 ps-0">
            
            <div class="text-center">
                <img src="{{asset('admin/assets/images/logo/small-logo.png')}}" width="55" height="55" class="rounded-xl shadow-l gradient-blue">
                
            </div>
        </div>
    </div>
    <div class="content mt-2 mb-0">
        <h2 class="mb-3 color-highlight text-center">Verification Code</h2>
        
        <form method="post" action="{{route('otp.verifycode')}}">
            @csrf
            <input type="hidden" name="id" value="{{$details['id']}}">
            <div class="text-center mb-3 pt-3 pb-2">
					
						<input id="input1" class="otp mx-1 rounded-sm text-center font-20 font-900" type="tel" placeholder="&#10059;" required>
						<input id="input2" class="otp mx-1 rounded-sm text-center font-20 font-900" type="tel" placeholder="&#10059;" required>
						<input id="input3" class="otp mx-1 rounded-sm text-center font-20 font-900" type="tel" placeholder="&#10059;" required>
						<input id="input4" class="otp mx-1 rounded-sm text-center font-20 font-900" type="tel" placeholder="&#10059;" required>
					
				</div>
            
                <input type="hidden"  id="form1a"  name="otp" >
                
            
           
            
            <center>
                <input type="submit" class="btn btn-m mt-4 mb-4 btn-full bg-green-dark rounded-sm text-uppercase font-900" value="Submit">
            </center>
            
        </form>
        <div class="divider mt-4 mb-3"></div>
        
        
    </div>
    
</div>

@endsection
@section('footer')
@parent
@endsection
@section('footerscript')
@parent
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script>
$(document).ready(function() {
     $('body').on('change', '#input1, #input2, #input3, #input4', function () {

    var value1 = $('#input1').val();
    var value2 = $('#input2').val();
    var value3 = $('#input3').val();
    var value4 = $('#input4').val();

    var combinedValue = value1 + value2 + value3 + value4;
    $('#form1a').val(combinedValue);
  });
});
</script>
@endsection