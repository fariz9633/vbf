@extends('includes.master')

@section('headerscript')
@parent
<style>

.mdetails{
        display:none;
    }
@media (max-width: 565px) { 
    .ddetails{
        display:none;
    }
    .mdetails{
        display:block !important;
    }
}


</style>
@endsection

@section('header')
@parent
@endsection

@section('content')

<div class="page-title page-title-small">
    <!--<a href="#" data-back-button><i class="fa fa-arrow-left"></i></a>-->
    <h2>My Karma</h2>
    
    <div class="ddetails text-capitalize" style="position: fixed;top: 32px;color: white;left: 185px;"> {{Auth::guard('customer')->user()->reg_id}}</div>
    <div class="mdetails text-capitalize" style="position: fixed;top: 32px;color: white;left: 135px;"> {{Auth::guard('customer')->user()->reg_id}}</div>
      <!--<a class=" float-end lan-btn btn changeLang" id="{{ __('messages.langid') }}" href="#" ><span>{{ __('messages.lang') }}</span></a>-->
       @if(Auth::guard('customer')->user()->profile)
      <a href="#" data-menu="menu-main" class="bg-fade-highlight-light shadow-xl preload-img" data-src="{{asset('uploads/customer')}}/{{Auth::guard('customer')->user()->profile}}"></a>
        
        @else
         <a href="#" data-menu="menu-main" class="bg-fade-highlight-light shadow-xl preload-img" data-src="{{url('public/images/avatars/5s.png')}}"></a>
        @endif
  
</div>
<div class="card header-card shape-rounded" data-card-height="150">
    <div class="card-overlay bg-highlight opacity-95"></div>
    <div class="card-overlay dark-mode-tint"></div>
    <div class="card-bg preload-img" data-src="{{url('public/images/pictures/20s.jpg') }}"></div>
</div>

@if(Session::has('success'))

<div class="ms-3 me-3 alert alert-small rounded-s shadow-xl bg-green-dark s-alrt" role="alert">
    <span><i class="fa fa-check"></i></span>
    <strong>{{ Session::get('success') }}</strong>
    <button type="button" class="close color-white opacity-60 font-16" data-bs-dismiss="alert" aria-label="Close">&times;</button>
</div>

@endif
<div class="card card-style opportunity_section">
            <div class="content">
                <div class="row mb-3">
                    <h2 class="text-center pb-3">My Karma</h2>
                    <div class="col-lg-6 col-sm-6 col-6 font-20 text-center px-0">
                     
                     <h1 class="color-highlight mb-0 pb-1"><?=$data['given'];?></h1>
                        <h5 class="color-theme text-center font-13 font-500 line-height-s pb-3 mb-3">{{ __('messages.dashboardtitle') }}<br> {{ __('messages.dashboardtitle1') }}</h5>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-6 font-20 text-center px-0">
                       
                         <h1 class="color-highlight mb-0 pb-1"><?=$data['received'];?></h1>
                        <h5 class="color-theme text-center  font-13 font-500 line-height-s pb-3 mb-3">{{ __('messages.dashboardtitle13') }} <br> {{ __('messages.dashboardtitle14') }}</h5>
                    </div>
                    
                    <div class="col-lg-6 col-sm-6 col-6 font-20 text-center px-0">
                      
                         <h1 class="color-highlight mb-0 pb-1"><?=$data['total'];?></h1>
                        <h5 class="color-theme text-center  font-13 font-500 line-height-s pb-3 mb-3">Total Meetings</h5>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-6 font-20 text-center px-0">
                     
                      <h1 class="color-highlight mb-0 pb-1"><?=$data['attended'];?></h1>
                        <h5 class="color-theme text-center  font-13 font-500 line-height-s pb-3 mb-3"> {{ __('messages.dashboardtitle9') }}</h5>
                    </div>
                
                </div>
            </div>
        </div>
        <div class="card card-style dashboard_section">
            <div class="content">
                <div class="row mb-0 py-2">
                    <h2 class="text-center pb-4">{{ __('messages.dashboardappshead') }}</h2>
                    <div class="col-sm-6 col-lg-3 col-6 mb-3 ">
                        <a href="{{route('login.meetings')}}">
                            <div class="card card-style me-0 mb-3 text-center mobile-size">
                                <h1 class="center-text pt-sm-4 pt-2 mt-2">
                                  <a href="{{route('login.meetings')}}"><img src="{{asset('images/avatars/total_meeting.png')}}" class=" rounded-circle bg-fade-red-light shadow-l" width="60"></a>  
                                </h1>
                                
                                <p class="mt-n2 pt-2 fw-400 pb-sm-4 pb-2 mb-0 font-19 ">{{ __('messages.dashboardappstitle1') }}</p>
                                <p class="font-10 opacity-30 mb-1"></p>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-lg-3 col-6 mb-3 ">
                        <a href="{{route('login.events')}}">
                            <div class="card card-style me-0 mb-3 text-center mobile-size">
                                <h1 class="center-text pt-sm-4 pt-2 mt-2">
                                  <a href="{{route('login.events')}}"><img src="{{asset('images/avatars/event.jpg')}}" class=" rounded-circle bg-fade-red-light shadow-l" width="60"></a>  
                                </h1>
                                
                                <p class="mt-n2 pt-2 fw-400 pb-sm-4 pb-2 mb-0 font-19 ">Events</p>
                                <p class="font-10 opacity-30 mb-1"></p>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-lg-3 col-6 mb-3 ">
                        <a href="{{route('login.news')}}">
                            <div class="card card-style me-0 mb-3 text-center mobile-size">
                                <h1 class="center-text pt-sm-4 pt-2 mt-2">
                                  <a href="{{route('login.news')}}"><img src="{{asset('images/avatars/news-1.jpg')}}" class=" rounded-circle bg-fade-red-light shadow-l" width="60"></a>  
                                </h1>
                                
                                <p class="mt-n2 pt-2 fw-400 pb-sm-4 pb-2 mb-0 font-19 ">News</p>
                                <p class="font-10 opacity-30 mb-1"></p>
                            </div>
                        </a>
                   </div>
                    <div class="col-sm-6 col-lg-3 col-6 mb-3 ">
                        <a href="{{route('login.calender')}}">
                            <div class="card card-style me-0 mb-3 text-center mobile-size">
                                <h1 class="center-text pt-sm-4 pt-2 mt-2">
                                  <a href="{{route('login.calender')}}"><img src="{{asset('images/avatars/vbf_mett_att.png')}}" class=" rounded-circle bg-fade-red-light shadow-l" width="60"></a>  
                                </h1>
                                
                                <p class="mt-n2 pt-2 fw-400 pb-sm-4  pb-2 mb-0 font-19 ">
                                    {{ __('messages.dashboardappstitle3') }}

                                </p>
                                <p class="font-10 opacity-30 mb-1"></p>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-lg-3 col-6 mb-3 ">
                        <a href="{{route('login.profile')}}">
                            <div class="card card-style me-0 mb-3 text-center mobile-size">
                                <h1 class="center-text pt-sm-4 pt-2 mt-2">
                                  <a href="{{route('login.profile')}}"><img src="{{asset('images/avatars/vbf_opp.png')}}" class=" rounded-circle bg-fade-red-light shadow-l" width="60"></a>  
                                </h1>
                                
                                <p class="mt-n2 pt-2 fw-400 pb-sm-4  pb-2 mb-0 font-19 ">
                                     {{ __('messages.dashboardappstitle4') }}
                                </p>
                                <p class="font-10 opacity-30 mb-1"></p>
                            </div>
                        </a>

                    </div>
                    <div class="col-sm-6 col-lg-3 col-6 mb-3 ">
                        <a href="{{route('login.gallery')}}">
                            <div class="card card-style me-0 mb-3 text-center mobile-size">
                                <h1 class="center-text pt-sm-4 pt-2 mt-2">
                                  <a href="{{route('login.gallery')}}"><img src="{{asset('images/avatars/gallery.jpeg')}}" class=" rounded-circle bg-fade-red-light shadow-l" width="60"></a>  
                                </h1>
                                
                                <p class="mt-n2 pt-2 fw-400 pb-sm-4  pb-2 mb-0 font-19 ">
                                     Album
                                </p>
                                <p class="font-10 opacity-30 mb-1"></p>
                            </div>
                        </a>

                    </div>
                    <div class="col-sm-6 col-lg-3 col-6 mb-3 ">
                        <a href="{{route('login.support')}}">
                            <div class="card card-style me-0 mb-3 text-center mobile-size">
                                <h1 class="center-text pt-sm-4 pt-2 mt-2">
                                  <a href="{{route('login.support')}}"><img src="{{asset('images/avatars/vbf_not_att.png')}}" class=" rounded-circle bg-fade-red-light shadow-l" width="60"></a>  
                                </h1>
                                
                                <p class="mt-n2 pt-2 fw-400 pb-sm-4  pb-2 mb-0 font-19 ">
                                     {{ __('messages.dashboardappstitle6') }}

                                </p>
                                <p class="font-10 opacity-30 mb-1"></p>
                            </div>
                        </a>

                    </div>
                </div>
                
            </div>
        </div>

@endsection

@section('footer')
@parent
@endsection

@section('footerscript')
@parent
@endsection