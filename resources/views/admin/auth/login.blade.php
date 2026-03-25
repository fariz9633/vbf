<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--<link rel="icon" href="{{asset('admin/assets/images/logo/favicon-icon.png')}}" type="image/x-icon">-->
    <link rel="shortcut icon" href="{{asset('admin/assets/images/logo/favicon.ico')}}" type="image/x-icon">
    <title>VBF</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <!--<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/font-awesome.css')}}">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/icofont.css')}}">
    <!-- Themify icon-->
    <!--<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/themify.css')}}">-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css"/>
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/flag-icon.css')}}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/feather-icon.css')}}">
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{asset('admin/assets/css/color-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/responsive.css')}}">
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
    <!-- page-wrapper Start-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-5" style="background-color: rgba(99,98,231,0.1);" ><img class="bg-img-cover bg-center"  src="{{asset('admin/assets/images/login/3.png')}}" alt="looginpage"></div>
        <div class="col-xl-7 p-0">
            
            
            
              @if(\Session::get('success'))
         <div class="position-fixed top-0 end-0 p-3 dmo">
                      <div class="toast defaul-show-toast align-items-center text-white bg-success position-relative" aria-live="assertive" data-bs-autohide="true" aria-atomic="false">
                      <div class="toast-body">{{ \Session::get('success') }}   
                        <button class="btn-close btn-close-white position-absolute top-50 end-0 translate-middle" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
                      </div>
                    </div>
                    </div>
        @endif
        {{ \Session::forget('success') }}
        @if(\Session::get('error'))
         <div class="position-fixed top-0 end-0 p-3 dmo">
                      <div class="toast defaul-show-toast align-items-center text-white bg-danger position-relative" aria-live="assertive" data-bs-autohide="true" aria-atomic="false">
                      <div class="toast-body">{{ \Session::get('error') }}   
                        <button class="btn-close btn-close-white position-absolute top-50 end-0 translate-middle" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
                      </div>
                    </div>
                    </div>
        @endif  
            
           
                    
                    
          <div class="login-card">
            <form class="theme-form login-form needs-validation" action="{{ route('adminLoginPost') }}" method="post">
               {!! csrf_field() !!}
              <h4>Login</h4>
              <h6>Welcome back! Log in to your account.</h6>
              
                 @php
                  $suc = Session::get('email');
                 @endphp
        
        
              <div class="form-group">
                <label>Email Address</label>
                <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                  <input class="form-control" type="email" name="email" required="" placeholder="Enter Email" value="<?= Session::has('email')  ? ''.$suc : '' ?>">
                  
                   {{ \Session::forget('email') }}
                  
                 <!--<div class="invalid-tooltip"> Please enter proper email.</div>-->  
                </div>
              </div>
              <div class="form-group">
                <label>Password</label>
                <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                  <input class="form-control" type="password" name="password" required="" placeholder="Enter Password">
                  <!--<div class="invalid-tooltip">Please enter password.</div>-->
                    @if ($errors->has('password'))
                   <div class="invalid-tooltip">{{ $errors->first('password') }}</div>
                   @endif
                </div>
              </div>
              
              <div class="form-group">
                <input class="btn btn-primary btn-block" type="submit" value="Sign in" >
              </div>
             
            </form>
          </div>
        </div>
      </div>
    </div>
    <script>
      (function() {
      'use strict';
      window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
      if (form.checkValidity() === false) {
      event.preventDefault();
      event.stopPropagation();
      }
      form.classList.add('was-validated');
      }, false);
      });
      }, false);
      })();
    </script>
    <!-- latest jquery-->
    <script src="{{asset('admin/assets/js/jquery-3.5.1.min.js')}}"></script>
    <!-- Bootstrap js-->
    <script src="{{asset('admin/assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <!-- feather icon js-->
    <script src="{{asset('admin/assets/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/icons/feather-icon/feather-icon.js')}}"></script>
    <!-- scrollbar js-->
    <!-- Sidebar jquery-->
    <script src="{{asset('admin/assets/js/config.js')}}"></script>
    <!-- Plugins JS start-->
    <script src="{{asset('admin/assets/js/sidebar-menu.js')}}"></script>
    <script src="{{asset('admin/assets/js/height-equal.js')}}"></script>
    <script src="{{asset('admin/assets/js/toasts/toasts-custom.js')}}"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{asset('admin/assets/js/script.js')}}"></script>
    <!-- login js-->
    <!-- Plugin used-->
  </body>
</html>