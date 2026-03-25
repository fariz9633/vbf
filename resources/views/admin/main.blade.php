<!DOCTYPE html>
<html lang="en"> 
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <!--<link rel="icon" href="{{ asset('admin/assets/images/logo/favicon-icon.png') }}" type="image/x-icon">-->
  <link rel="shortcut icon" href="{{ asset('admin/assets/images/logo/favicon.ico') }}" type="image/x-icon">
  <title>VBF</title>
  
  
  <!-- Google font-->
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
  <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
  <!--<link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/font-awesome.css') }}">-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>
  <!-- ico-font-->
  <!--<link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/icofont.css') }}">-->
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/icofont/icofont.min.css') }}">
  <!--<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">-->
  <!-- Themify icon-->
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/themify.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css"/>
  <!-- Flag icon-->
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/flag-icon.css') }}">
  <!-- Feather icon-->
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/feather-icon.css') }}">
  <!-- Plugins css start-->
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/scrollbar.css') }}">
  
  
  @section('menubar_script')
  @show
  
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/animate.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/date-picker.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/photoswipe.css') }}">
  <!-- Plugins css Ends-->
  <!-- Bootstrap css-->
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/bootstrap.css') }}">
  <!-- App css-->
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/style.css') }}">
  <link id="color" rel="stylesheet" href="{{ asset('admin/assets/css/color-1.css') }}" media="screen">
  <!-- Responsive css-->
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/responsive.css') }}">
  
  <style>
    .customizer-links{
      display : none;
    }
    .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .simplebar-offset {
      height: auto;
    }
  </style>
  
  
</head>
<body>     
  <!-- Loader starts-->
  <div class="loader-wrapper">
    <div class="loader">
      <div class="loader-bar"></div>
      <div class="loader-bar"></div>
      <div class="loader-bar"></div>
      <div class="loader-bar"></div>
      <div class="loader-bar"></div>
      <div class="loader-ball"></div>
    </div>
  </div>
  <!-- Loader ends-->
  <!-- tap on top starts-->
  <div class="tap-top"><i data-feather="chevrons-up"></i></div>
  <!-- tap on tap ends-->
  <!-- page-wrapper Start-->
  <div class="page-wrapper compact-wrapper" id="pageWrapper">
    
    @section('menubar')
    <!-- Page Header Start-->
    <div class="page-header">
      <div class="header-wrapper row m-0"> 
        <div class="header-logo-wrapper col-auto p-0">
          <div class="logo-wrapper">
            <a href="{{ route('admindashboard') }}">
              <img class="img-fluid" src="{{ asset('admin/assets/images/logo/logo.png') }}" alt=""> 
            </a>
            <span class="text-dark">VBF</span>
          </div>
          <div class="toggle-sidebar">
            <div class="status_toggle sidebar-toggle d-flex">        
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g> 
                  <g> 
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M21.0003 6.6738C21.0003 8.7024 19.3551 10.3476 17.3265 10.3476C15.2979 10.3476 13.6536 8.7024 13.6536 6.6738C13.6536 4.6452 15.2979 3 17.3265 3C19.3551 3 21.0003 4.6452 21.0003 6.6738Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.3467 6.6738C10.3467 8.7024 8.7024 10.3476 6.6729 10.3476C4.6452 10.3476 3 8.7024 3 6.6738C3 4.6452 4.6452 3 6.6729 3C8.7024 3 10.3467 4.6452 10.3467 6.6738Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M21.0003 17.2619C21.0003 19.2905 19.3551 20.9348 17.3265 20.9348C15.2979 20.9348 13.6536 19.2905 13.6536 17.2619C13.6536 15.2333 15.2979 13.5881 17.3265 13.5881C19.3551 13.5881 21.0003 15.2333 21.0003 17.2619Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.3467 17.2619C10.3467 19.2905 8.7024 20.9348 6.6729 20.9348C4.6452 20.9348 3 19.2905 3 17.2619C3 15.2333 4.6452 13.5881 6.6729 13.5881C8.7024 13.5881 10.3467 15.2333 10.3467 17.2619Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                  </g>
                </g>
              </svg>
            </div>
          </div>
        </div>
        <div class="left-side-header col ps-0 d-none d-md-block">
          
        </div>
        <div class="nav-right col-10 col-sm-6 pull-right right-header p-0">
          <ul class="nav-menus">
              
             
             
            <li>
              <div class="mode animated backOutRight">
                <svg class="lighticon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g>
                    <g>                 
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M18.1377 13.7902C19.2217 14.8742 16.3477 21.0542 10.6517 21.0542C6.39771 21.0542 2.94971 17.6062 2.94971 13.3532C2.94971 8.05317 8.17871 4.66317 9.67771 6.16217C10.5407 7.02517 9.56871 11.0862 11.1167 12.6352C12.6647 14.1842 17.0537 12.7062 18.1377 13.7902Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                  </g>
                </svg>
                <svg class="darkicon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M17 12C17 14.7614 14.7614 17 12 17C9.23858 17 7 14.7614 7 12C7 9.23858 9.23858 7 12 7C14.7614 7 17 9.23858 17 12Z"></path>
                  <path d="M18.3117 5.68834L18.4286 5.57143M5.57144 18.4286L5.68832 18.3117M12 3.07394V3M12 21V20.9261M3.07394 12H3M21 12H20.9261M5.68831 5.68834L5.5714 5.57143M18.4286 18.4286L18.3117 18.3117" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
              </div>
            </li>
            <li class="profile-nav onhover-dropdown pe-0 py-0 me-0">
              <div class="media profile-media">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g> 
                    <g> 
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M9.55851 21.4562C5.88651 21.4562 2.74951 20.9012 2.74951 18.6772C2.74951 16.4532 5.86651 14.4492 9.55851 14.4492C13.2305 14.4492 16.3665 16.4342 16.3665 18.6572C16.3665 20.8802 13.2505 21.4562 9.55851 21.4562Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M9.55849 11.2776C11.9685 11.2776 13.9225 9.32356 13.9225 6.91356C13.9225 4.50356 11.9685 2.54956 9.55849 2.54956C7.14849 2.54956 5.19449 4.50356 5.19449 6.91356C5.18549 9.31556 7.12649 11.2696 9.52749 11.2776H9.55849Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                      <path d="M16.8013 10.0789C18.2043 9.70388 19.2383 8.42488 19.2383 6.90288C19.2393 5.31488 18.1123 3.98888 16.6143 3.68188" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                      <path d="M17.4608 13.6536C19.4488 13.6536 21.1468 15.0016 21.1468 16.2046C21.1468 16.9136 20.5618 17.6416 19.6718 17.8506" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                  </g>
                </svg>
              </div>
              <ul class="profile-dropdown onhover-show-div">
                  @php $id = session('admin.admin_id'); @endphp
                <li><a href="{{ url('admin/edit_profile/'.$id)}}"><i data-feather="user"></i><span>Edit Profile </span></a></li>
                <li><a href="{{ route('adminLogout') }}"><i data-feather="log-in"> </i><span>Log Out</span></a></li>
              </ul>
            </li>
          </ul>
        </div>
        
      </div>
    </div>
    <!-- Page Header Ends-->
    @show

    <!-- Page Body Start-->
    <div class="page-body-wrapper">
      
      @section('leftmenu')
      <!-- Page Sidebar Start-->
      <div class="sidebar-wrapper"> 
        <div>
          <div class="logo-wrapper"><a href="{{ route('admindashboard') }}"><img class="img-fluid for-light" src="{{ asset('admin/assets/images/logo/small-logo.png') }}" alt=""><img class="img-fluid for-dark" src="{{ asset('admin/assets/images/logo/small-white-logo.png') }}" alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
          </div>
          <div class="logo-icon-wrapper"><a href="{{ route('admindashboard') }}"><img class="img-fluid" src="{{ asset('admin/assets/images/logo-icon.png') }}" alt=""></a></div>
          <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
              <ul class="sidebar-links" id="simple-bar">
                <li class="back-btn">
                    <a href="{{ route('admindashboard') }}">
                        <img class="img-fluid" src="{{ asset('admin/assets/images/logo-icon.png') }}" alt="">
                    </a>
                  <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true">        </i></div>
                </li>
                <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title link-nav " href="{{ route('admindashboard') }}">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g>
                        <g> 
                          <path d="M9.07861 16.1355H14.8936" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M2.3999 13.713C2.3999 8.082 3.0139 8.475 6.3189 5.41C7.7649 4.246 10.0149 2 11.9579 2C13.8999 2 16.1949 4.235 17.6539 5.41C20.9589 8.475 21.5719 8.082 21.5719 13.713C21.5719 22 19.6129 22 11.9859 22C4.3589 22 2.3999 22 2.3999 13.713Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </g>
                      </g>
                    </svg>
                    <span class="">Dashboard</span></a>
                    
                  </li>
                  @php
                  $id = session('admin.admin_id');
                  $rol = DB::table('pwa_user_roles')->where('admin_id', $id)->get();
                 
                  @endphp
                  @foreach($rol as $roles)
                    @if($roles->roles_id == 1)
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <g> 
                            <g> 
                              <path d="M6.91699 14.854L9.90999 10.965L13.324 13.645L16.253 9.86499" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M19.6671 2.3501C20.7291 2.3501 21.5891 3.2101 21.5891 4.2721C21.5891 5.3331 20.7291 6.1941 19.6671 6.1941C18.6051 6.1941 17.7451 5.3331 17.7451 4.2721C17.7451 3.2101 18.6051 2.3501 19.6671 2.3501Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path d="M20.7555 9.26898C20.8885 10.164 20.9495 11.172 20.9495 12.303C20.9495 19.241 18.6375 21.553 11.6995 21.553C4.76246 21.553 2.44946 19.241 2.44946 12.303C2.44946 5.36598 4.76246 3.05298 11.6995 3.05298C12.8095 3.05298 13.8005 3.11198 14.6825 3.23998" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </g>
                          </g>
                        </svg><span>Home</span></a>
                        <ul class="sidebar-submenu">
                          <li><a href="{{route('adminbanner')}}">Banners</a></li>
                          <li><a href="{{route('adminnews')}}">News</a></li>
                          <li><a href="{{route('adminactivities')}}">Resources</a></li>
                          <li><a href="{{route('adminscheme')}}">Insight</a></li>
                          <li><a href="{{route('adminabout')}}">Faq</a></li>
                          <li><a href="{{route('admincontent')}}">Content</a></li>
                          <li><a href="{{route('adminevents')}}">Events</a></li>
                          <li><a href="{{route('admindocument')}}">Other Document</a></li>
                        </ul>
                      </li>
                    @endif
                    @if($roles->roles_id == 2)
                     <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g>
                        <g> 
                          <path d="M15.596 15.6963H8.37598" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          <path d="M15.596 11.9365H8.37598" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          <path d="M11.1312 8.17725H8.37622" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M3.61011 12C3.61011 18.937 5.70811 21.25 12.0011 21.25C18.2951 21.25 20.3921 18.937 20.3921 12C20.3921 5.063 18.2951 2.75 12.0011 2.75C5.70811 2.75 3.61011 5.063 3.61011 12Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </g>
                      </g>
                    </svg><span>Master Tables</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="{{route('admincategory')}}">Category</a></li>
                      <li><a href="{{route('adminsubcategory')}}">Sub category</a></li>
                      <li><a href="{{route('adminchapter')}}">Vahini's</a></li>
                      <li><a href="{{route('admincountry')}}">Country</a></li>
                      <li><a href="{{route('adminstate')}}">State</a></li>
                      <li><a href="{{route('admindesignation')}}">Designation</a></li>
                      <li><a href="{{route('adminnature')}}">Nature</a></li>
                      <li><a href="{{route('adminopportunitytype')}}">Requirement Type</a></li>
                      <!--<li><a href="{{route('adminopportunityconnect')}}">Opportunity Connecting</a></li>-->
                      <li><a href="{{route('adminreferencetype')}}">Reference Type</a></li>
                      <li><a href="{{route('adminreferalstatus')}}">Priorities</a></li>
                      <!--<li><a href="{{route('adminsupport')}}">Support</a></li>-->
                      <!--<li><a href="{{route('admindepartment')}}">Department</a></li>-->
                      <!--<li><a href="{{route('admindepartmentmem')}}">Department members</a></li>-->
                      <li><a href="{{route('admingallery')}}">Gallery</a></li>
                        <li><a href="{{route('admin.terms.edit')}}">Terms & Conditions</a></li>
                    </ul>
                  </li>
                    @endif
                    @if($roles->roles_id == 3)
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g> 
                          <g> 
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9724 20.3683C8.73343 20.3683 5.96643 19.8783 5.96643 17.9163C5.96643 15.9543 8.71543 14.2463 11.9724 14.2463C15.2114 14.2463 17.9784 15.9383 17.9784 17.8993C17.9784 19.8603 15.2294 20.3683 11.9724 20.3683Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9725 11.4488C14.0985 11.4488 15.8225 9.72576 15.8225 7.59976C15.8225 5.47376 14.0985 3.74976 11.9725 3.74976C9.84645 3.74976 8.12245 5.47376 8.12245 7.59976C8.11645 9.71776 9.82645 11.4418 11.9455 11.4488H11.9725Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M18.3622 10.3915C19.5992 10.0605 20.5112 8.93254 20.5112 7.58954C20.5112 6.18854 19.5182 5.01854 18.1962 4.74854" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M18.9431 13.5444C20.6971 13.5444 22.1951 14.7334 22.1951 15.7954C22.1951 16.4204 21.6781 17.1014 20.8941 17.2854" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M5.58372 10.3915C4.34572 10.0605 3.43372 8.93254 3.43372 7.58954C3.43372 6.18854 4.42772 5.01854 5.74872 4.74854" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M5.00176 13.5444C3.24776 13.5444 1.74976 14.7334 1.74976 15.7954C1.74976 16.4204 2.26676 17.1014 3.05176 17.2854" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          </g>
                        </g>
                      </svg><span>User Management</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="{{route('adminpermissions')}}">Roles & Permissions</a></li>
                      <li><a href="{{route('adminuser')}}">Manage Users</a></li>
                    </ul>
                  </li>
                    @endif
                    @if($roles->roles_id == 4)
                    
                     <li class="sidebar-list">
                         <a class="sidebar-link sidebar-title " href="#">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g> 
                          <g>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M21.4399 13.9939C18.7789 13.9939 18.7789 9.87952 21.4399 9.87952C21.4399 5.11236 21.4399 3.41089 12.0449 3.41089C2.6499 3.41089 2.6499 5.11236 2.6499 9.87952C5.3109 9.87952 5.3109 13.9939 2.6499 13.9939C2.6499 18.762 2.6499 20.4635 12.0449 20.4635C21.4399 20.4635 21.4399 18.762 21.4399 13.9939Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0449 9.17114C11.3619 9.17114 11.2969 10.2606 10.8909 10.6462C10.4839 11.0308 9.22087 10.5912 9.04487 11.2743C8.86987 11.9583 10.0069 12.1904 10.1479 12.7768C10.2879 13.3632 9.59387 14.1875 10.1869 14.5986C10.7809 15.0079 11.4199 14.0804 12.0449 14.0804C12.6699 14.0804 13.3089 15.0079 13.9029 14.5986C14.4969 14.1875 13.8019 13.3632 13.9419 12.7768C14.0829 12.1904 15.2199 11.9583 15.0449 11.2743C14.8689 10.5912 13.6059 11.0308 13.1989 10.6462C12.7929 10.2606 12.7279 9.17114 12.0449 9.17114Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          </g>
                        </g>
                      </svg>
                      <span>Approvals</span>
                      </a>
                    <ul class="sidebar-submenu">
                      <li><a href="{{route('adminapprovals')}}">Members </a></li>
                      <li><a href="{{route('adminapprovals.opportunity')}}">Requirements</a></li>
                      <li><a href="{{route('adminapprovals.socialmedia')}}">Business Post</a></li>
                    </ul>
                  </li>
                    
                    @endif
                    @if($roles->roles_id == 5)
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g> 
                          <g> 
                            <path d="M11.1437 17.8829H4.67114" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.205 17.8839C15.205 19.9257 15.8859 20.6057 17.9267 20.6057C19.9676 20.6057 20.6485 19.9257 20.6485 17.8839C20.6485 15.8421 19.9676 15.1621 17.9267 15.1621C15.8859 15.1621 15.205 15.8421 15.205 17.8839Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M14.1765 7.39439H20.6481" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.1153 7.39293C10.1153 5.35204 9.43436 4.67114 7.39346 4.67114C5.35167 4.67114 4.67078 5.35204 4.67078 7.39293C4.67078 9.43472 5.35167 10.1147 7.39346 10.1147C9.43436 10.1147 10.1153 9.43472 10.1153 7.39293Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          </g>
                        </g>
                      </svg>
                            <span>Meeting Management</span>
                        </a>
                    <ul class="sidebar-submenu">
                      <li><a href="{{route('adminmeetings')}}">Manage Meetings</a></li>
                      <!--<li><a href="{{route('adminmom')}}">Mom</a></li>-->
                      
                    </ul>
                  </li>
                    @endif
                    
                  @endforeach
              
               
                
                
                
                  
                  
                  
                </ul>
                
              </div>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </nav>
            
          </div>
          
        </div>
        
        @show
        
        @yield('content')
        
        
        @section('footerbar')
        <!-- footer start-->
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12 footer-copyright text-center">
                <p class="mb-0">Copyright {{ date('Y') }} © Mcware Technologies  </p>
                 
              @php
                    $appres = DB::table('appversions')->where('status', 1)->orderBy('id', 'desc')->first();
                    @endphp
              @if($appres)
              <a class=""  href="{{route('admin.appversions.view', $appres->id)}}">Version-{{$appres->versions}}</a>
              
              @endif
                    
              </div>
            </div>
          </div>
        </footer>
        @show
        
        
      </div>
      
      
    </div>

    <!-- latest jquery-->
    <script src="{{ asset('admin/assets/js/jquery-3.5.1.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('admin/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('admin/assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- scrollbar js-->
    <script src="{{ asset('admin/assets/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('admin/assets/js/scrollbar/custom.js') }}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('admin/assets/js/config.js') }}"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('admin/assets/js/sidebar-menu.js') }}"></script>
    
    <script src="{{ asset('admin/assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/notify/index.js') }}"></script>
    <script src="{{ asset('admin/assets/js/height-equal.js') }}"></script>
    @section('footerbar_script')
    @show
    
    
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{asset('admin/assets/js/toasts/toasts-custom.js')}}"></script>
    <script src="{{ asset('admin/assets/js/script.js') }}"></script>
    <script src="{{ asset('admin/assets/js/theme-customizer/customizer.js') }}"></script>
    <!-- login js-->
    <!-- Plugin used-->
    
  </body>
  </html>
  @show