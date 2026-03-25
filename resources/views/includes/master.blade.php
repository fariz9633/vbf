<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Primary Meta Tags -->

<meta name="title" content="Vipra Business Forum">
<meta name="description" content="">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="http://viprabusinessforum.org/">
<meta property="og:title" content="Vipra Business Forum">
<meta property="og:description" content="">
<meta property="og:image" content="{ asset('favicon.ico') }}">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="http://viprabusinessforum.org/">
<meta property="twitter:title" content="Vipra Business Forum">
<meta property="twitter:description" content="">
<meta property="twitter:image" content="{ asset('favicon.ico') }}">
    <title>{{ __('messages.Pojecttitle') }}</title>
    <!-- Meta -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @section('headerscript')

    <link rel="manifest" href="{{ asset('_manifest.json') }}" data-pwa-version="set_in_manifest_and_pwa_js">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('app/icons/icon-192x192.png') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/style.css') }}">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900|Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap" rel="stylesheet">

    <!--Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>

    <style>
        .lan-btn span 
        {
            position: absolute;
            right: 10px;
            top: 9px;
        }
        .language a
        {
            border-bottom: 0px solid !important;
        }
        .main-logo
        {
            font-size: 22px !important;
            line-height: 30px;
            color: #FFF;
            font-weight: 600 !important;
        }
    </style>

    @show
</head>

<body class="theme-light" data-highlight="orange">

    <div id="preloader"><div class="spinner-border color-highlight" role="status">
        
    </div></div>
    
    

    <div id="page">
        @section('header')

        <div class="header header-fixed header-auto-show header-logo-app">
            <a href="{{route('dashboard')}}" class="header-title">{{ __('messages.Pojecttitle') }}</a>
        </div>
@if(Auth::guard('customer')->check())
        <div id="footer-bar" class="footer-bar-5">
            
            @if(Auth::guard('customer')->user()->roles == 1)
            <a href="{{ route('login.media.list')}}" class="<?= (Route::currentRouteName()== 'login.media.list') || (Route::currentRouteName() == 'login.media.add') || (Route::currentRouteName() == 'login.media.posts') ? 'active-nav': '' ;?>">
                <i data-feather="file" data-feather-line="1" data-feather-size="21" data-feather-color="red-dark" data-feather-bg="red-fade-light"></i>
                <span>{{ __('messages.menu5') }}</span>
            </a>
            
            @else
           
            <a href="{{ route('login.dashboard') }}" class="<?= (Route::currentRouteName()== 'login.dashboard') || (Route::currentRouteName()== 'login.meetings') || (Route::currentRouteName()== 'login.meetings.detail') || (Route::currentRouteName()== 'login.events') || (Route::currentRouteName()== 'login.events.detail')  || (Route::currentRouteName()== 'login.news') || (Route::currentRouteName()== 'login.news.detail') || (Route::currentRouteName()== 'login.calender') || (Route::currentRouteName()== 'login.gallery') || (Route::currentRouteName()== 'login.support') || (Route::currentRouteName()== 'login.profile')  ? 'active-nav': '' ;?>">
                <i data-feather="settings" data-feather-line="1" data-feather-size="21" data-feather-color="brown-dark" data-feather-bg="brown-fade-light"></i>
                <span>My Karma</span>
            </a>
            @endif
             @if(Auth::guard('customer')->user()->roles == 1)
             @php
            $role = 1;
            $module = 2;
            $submodule = 3;
            $per = DB::table('permissions')->where('roles',$role)->where('modules',$module)->where('submodules',$submodule)->where('status',1)->first();
            @endphp
            <?php
            if(!empty($per)){ ?>
            <a href="{{ route('login.opportunity.list')}}" class="<?= (Route::currentRouteName() == 'login.opportunity.list') || (Route::currentRouteName() == 'login.enquiry.add') || (Route::currentRouteName() == 'login.opportunity.add') || (Route::currentRouteName() == 'login.opportunity.details') ? 'active-nav': '' ;?>">
                <i data-feather="globe" data-feather-line="1" data-feather-size="21" data-feather-color="dark-dark" data-feather-bg="gray-fade-light"></i>
                <span>{{ __('messages.menu4') }}</span>
            </a>
            <?php } ?>
            
            @else
            @php
            $role = 2;
            $module = 1;
            $submodule = 1;
            $per = DB::table('permissions')->where('roles',$role)->where('modules',$module)->where('submodules',$submodule)->where('status',1)->first();
            @endphp
            <?php
            if(!empty($per)){ ?>
            <a href="{{ route('login.opportunity.list')}}" class="<?= (Route::currentRouteName()== 'login.opportunity.list') || (Route::currentRouteName() == 'login.enquiry.add') || (Route::currentRouteName() == 'login.opportunity.add') || (Route::currentRouteName() == 'login.opportunity.details') ? 'active-nav': '' ;?>">
                <i data-feather="globe" data-feather-line="1" data-feather-size="21" data-feather-color="dark-dark" data-feather-bg="gray-fade-light"></i>
                <span>{{ __('messages.menu4') }}</span>
            </a>
            <?php } ?>
             
            @endif
            
            <a href="{{ route('dashboard') }}" class="<?= (Route::currentRouteName()== 'dashboard') || (Route::currentRouteName()== 'login.profile') || (Route::currentRouteName()== 'checkstatus') || (Route::currentRouteName()== 'verifymobile') || (Route::currentRouteName()== 'maintanence')  ? 'active-nav': '' ;?>"> 
                <i data-feather="home" data-feather-line="1" data-feather-size="21" data-feather-color="blue-dark" data-feather-bg="blue-fade-light"></i>
                <span>VBF</span>
            </a>
            
             @if(Auth::guard('customer')->user()->roles == 1)
             <a href="{{ route('login.meetings') }}" class="<?= (Route::currentRouteName()== 'login.meetings') || (Route::currentRouteName()== 'login.meetings.detail') ? 'active-nav': '' ;?>">
                <i data-feather="settings" data-feather-line="1" data-feather-size="21" data-feather-color="brown-dark" data-feather-bg="brown-fade-light"></i>
                <span>Meetings</span>
            </a>
            
            @else
            @php
            $role = 2;
            $module = 2;
            $submodule = 3;
            $per = DB::table('permissions')->where('roles',$role)->where('modules',$module)->where('submodules',$submodule)->where('status',1)->first();
            @endphp
            <?php
            if(!empty($per)){ ?>
             <a href="{{ route('login.members.list')}}" class="<?= (Route::currentRouteName()== 'login.members.list') || (Route::currentRouteName()== 'login.member.details') ? 'active-nav': '' ;?>">
                <i data-feather="heart" data-feather-line="1" data-feather-size="21" data-feather-color="green-dark" data-feather-bg="green-fade-light"></i>
                <span>Directory</span>
            </a>
            <?php } ?>
            
            @endif
            @if(Auth::guard('customer')->user()->roles == 1)
            <a href="{{ route('login.news')}}" class="<?= (Route::currentRouteName()== 'login.news') || (Route::currentRouteName()== 'login.news.detail') ? 'active-nav': '' ;?>">
                <i data-feather="heart" data-feather-line="1" data-feather-size="21" data-feather-color="green-dark" data-feather-bg="green-fade-light"></i>
                <span>News</span>
            </a>
            @else
            <a href="{{ route('login.media.list')}}" class="<?= (Route::currentRouteName()== 'login.media.list') || (Route::currentRouteName() == 'login.media.add') || (Route::currentRouteName() == 'login.media.posts') ? 'active-nav': '' ;?>">
                <i data-feather="file" data-feather-line="1" data-feather-size="21" data-feather-color="red-dark" data-feather-bg="red-fade-light"></i>
                <span>{{ __('messages.menu5') }}</span>
            </a>
            @endif
            
        </div>

         @endif

        <div class="page-content" style="padding-bottom:0px;">
          
            @show
            @yield('content')
            
  
            @section('footer')
            
            <div class="footer mb-80" data-menu-load="{{ route('footer')}}"></div>
           


        </div> 

       

    </div>


 <div id="menu-main" class="menu menu-box-right menu-box-detached rounded-m" data-menu-width="260" data-menu-load="{{ url('mainmenu') }}" data-menu-active="nav-welcome" data-menu-effect="menu-over"></div>
        <div id="menu-language" class="menu menu-box-modal rounded-m" data-menu-height="150" data-menu-width="310">
            <div class="me-3 ms-3 mt-3">
                <h1 class="font-700 mb-n1">Select language</h1>
                <p class="font-11 mb-1">Please choose a Language.</p>
                <div class="list-group language list-custom-small">
                    <div class="row">
                        <div class="col-6">
                            <a href="#" class="changeLang" id="en">
                                <img class="me-3 mt-n1" width="20" src="{{ asset('images/flags/India.png')}}"><span>English</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="#" class="changeLang" id="ka">
                                <img class="me-3 mt-n1" width="20" src="{{ asset('images/flags/kannada.jpg')}}"><span>Kannada</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <input type="hidden" id="lngchk" value="{{ session()->get('langpop') == 'hide' ? 'hide' : '' }}">

        @show

    @section('footerscript')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('scripts/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('scripts/custom.js') }}"></script>
    <script type="text/javascript">

        $(document).ready(function() {

//success and error messages

            $(".s-alrt").fadeTo(2000, 500).fadeOut(1000, function(){
                $(".s-alrt").fadeOut(1000);
            });

//language change

            var load = document.getElementById('lngchk').value;
            var url = "{{ route('changeLang') }}";

            if(load != "hide")
            {
                $('#langser').modal('show');
            }

            $(".changeLang").click(function()
            {
                window.location.href = url + "?lang="+ $(this).attr('id');
            });

        });

    </script>
     <script>
        function hideAddressBar()
{
  if(!window.location.hash)
  {
      if(document.height < window.outerHeight)
      {
          document.body.style.height = (window.outerHeight + 50) + 'px';
      }

      setTimeout( function(){ window.scrollTo(0, 1); }, 50 );
  }
}

window.addEventListener("load", function(){ if(!window.pageYOffset){ hideAddressBar(); } } );
window.addEventListener("orientationchange", hideAddressBar );
    </script>

    @show

</body>
</html>
@show