@extends('includes.master')

@section('headerscript')
@parent
@endsection

@section('header')
@parent
@endsection

@section('content')

<div class="page-title page-title-small">
    <h2><a href="#" data-back-button><i class="fa fa-arrow-left"></i></a>{{ __('messages.profilehead') }}</h2>
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


<div class="card card-style profile-section">
            <div class="content page-profile-team">
                @php
        $id =  Auth::guard('customer')->user()->id;
        $data = DB::table('customers')->where('id', $id)->first();
        @endphp
                <div class="d-flex">
                    <div>
                        @if($data->profile)
                        <img src="{{asset('uploads/customer')}}/{{$data->profile}}" class="me-3 rounded-circle bg-fade-red-light shadow-l" width="50">
                        @else
                        <img src="{{asset('images/avatars/vbf_profile.png')}}" class="me-3 rounded-circle bg-fade-red-light shadow-l" width="50">
                        @endif
                    </div>
                    <div>
                        <h5 class="mt-3 mb-0 text-capitalize"> {{$data->username}}</h5>
                    <p class=" text-capitalize"> {{$data->reg_id}}</p>
                    </div>
                    
                </div>
                
                 
         <h3 class="mt-4 font-600">Basic Info</h3>
         <div class="divider mt-4 mb-3"></div>
         
        
                
                <div class="row mb-0">
                    @if($data->phone)
                    <div class="col-6 mb-2">
                        <p class="font-600 mb-n1 color-highlight">Phone</p>
                        <p>{{$data->phone}}</p>
                    </div>
                    @endif
                     @if($data->email)
                    <div class="col-6 mb-2">
                        <p class="font-600 mb-n1 color-highlight">Email</p>
                        <p>{{$data->email}}</p>
                    </div>
                    @endif
                    @if($data->address)
                    <div class="col-6 mb-2">
                        <p class="font-600 mb-n1 color-highlight">Address</p>
                        <p>{{$data->address}}</p>
                    </div>
                    @endif
                     @if($data->city)
                    <div class="col-6 mb-2">
                        <p class="font-600 mb-n1 color-highlight">City</p>
                        <p>{{$data->city}}</p>
                    </div>
                    @endif
                    @if($data->pincode)
                    <div class="col-6 mb-2">
                        <p class="font-600 mb-n1 color-highlight">Pincode</p>
                        <p>{{$data->pincode}}</p>
                    </div>
                    @endif
                    @if($data->category)
                    @php
                    $catdetails = DB::table('pwa_category')->where('id',$data->category)->first();
                    @endphp
                    @if($catdetails)
                    <div class="col-6 mb-2">
                        <p class="font-600 mb-n1 color-highlight">Category</p>
                        
                        <p>{{$catdetails->name}}</p>
                    </div>
                    @endif
                    @endif
                    @if($data->subcategory)
                    <div class="col-6 mb-2">
                        <p class="font-600 mb-n1 color-highlight">Sub Category</p>
                        @php
                        
                        $subcatdetails = DB::table('pwa_subcategory')->where('id',$data->subcategory)->first();
                        
                        @endphp
                        @if($subcatdetails)
                        <p>{{$subcatdetails->name}}</p>
                        @endif
                    </div>
                    @endif
                    @if($data->chapter)
                    <div class="col-6 mb-2">
                        <p class="font-600 mb-n1 color-highlight">Vahini</p>
                        @php
                        $chapdetails = DB::table('pwa_chapter')->where('id',$data->chapter)->first();
                        @endphp
                        <p>{{$chapdetails->name}}</p>
                    </div>
                    @endif
                    @if($data->descp)
                    <div class="col-6 mb-2">
                        <p class="font-600 mb-n1 color-highlight">Description</p>
                        <p>{{$data->descp}}</p>
                    </div>
                    @endif
                    @if($data->keyword)
                    <div class="col-6 mb-2">
                        <p class="font-600 mb-n1 color-highlight">Keyword</p>
                        <p>{{$data->keyword}}</p>
                    </div>
                    @endif
                    @if($data->dob)
                    <div class="col-6 mb-2">
                        <p class="font-600 mb-n1 color-highlight">Date of Birth</p>
                        <p>{{$data->dob}}</p>
                    </div>
                    @endif
                    @if($data->gender)
                    <div class="col-6 mb-2">
                        <p class="font-600 mb-n1 color-highlight">Gender</p>
                        <p>{{$data->gender}}</p>
                    </div>
                    @endif
                    @if($data->martial)
                    <div class="col-6 mb-2">
                        <p class="font-600 mb-n1 color-highlight">Martial Status</p>
                        @if($data->martial == 1)
                        <p>Married</p>
                        @elseif($data->martial == 2)
                        <p>Unmarried</p>
                        @else
                        <p></p>
                        @endif
                        
                    </div>
                    @endif
                     @if($data->martial_date)
                    <div class="col-6 mb-2">
                        <p class="font-600 mb-n1 color-highlight">Married Date</p>
                        <p>{{$data->martial_date}}</p>
                    </div>
                    @endif
                    
                    
                </div>
                
                
                
                
                
                
            </div>
        </div>
        
        @if(Auth::guard('customer')->user()->roles == 2)
        <div class="card card-style profile-section">
            <div class="content page-profile-team">
               
                <h4 class="font-700">Business Details</h4>
                
                
                <div class="row mb-0">
                     @if($data->bname)
                    <div class="col-6 mb-2">
                        <p class="font-600 mb-n1 color-highlight">Name</p>
                        <p>{{$data->bname}}</p>
                    </div>
                    @endif
                     @if($data->designation_id)
                    <div class="col-6 mb-2">
                        <p class="font-600 mb-n1 color-highlight">Designation</p>
                         @php
                        $desigdetails = DB::table('pwa_designation')->where('id', $data->designation_id)->first();
                        @endphp
                        <p>{{$desigdetails->name}}</p>
                    </div>
                    @endif
                    @if($data->nature)
                    <div class="col-6 mb-2">
                        <p class="font-600 mb-n1 color-highlight">Nature of Business</p>
                         @php
                        $natdetails = DB::table('pwa_nature')->where('id',$data->nature)->first();
                        @endphp
                        <p>{{$natdetails->name}}</p>
                    </div>
                    @endif
                     @if($data->bphone)
                    <div class="col-6 mb-2">
                        <p class="font-600 mb-n1 color-highlight">Phone</p>
                        <p>{{$data->bphone}}</p>
                    </div>
                    @endif
                    @if($data->bemail)
                    <div class="col-6 mb-2">
                        <p class="font-600 mb-n1 color-highlight">Email</p>
                        <p>{{$data->bemail}}</p>
                    </div>
                    @endif
                    @if($data->baddress)
                    <div class="col-6 mb-2">
                        <p class="font-600 mb-n1 color-highlight">Address</p>
                        <p>{{$data->baddress}}</p>
                    </div>
                    @endif
                    @if($data->bdate)
                    <div class="col-6 mb-2">
                        <p class="font-600 mb-n1 color-highlight">Date</p>
                        <p>{{$data->bdate}}</p>
                    </div>
                    @endif
                   
                </div>
                
                
                
                
                
                
            </div>
        </div>
        
        <div class="card card-style profile-section">
            <div class="content page-profile-team">
               
                <h4 class="font-700">Reference Details</h4>
                
                
                <div class="row mb-0">
                    @if($data->rname)
                    <div class="col-6 mb-2">
                        <p class="font-600 mb-n1 color-highlight">Name</p>
                        <p>{{$data->rname}}</p>
                    </div>
                    @endif
                    
                     @if($data->remail)
                    <div class="col-6 mb-2">
                        <p class="font-600 mb-n1 color-highlight">Email</p>
                        <p>{{$data->remail}}</p>
                    </div>
                    @endif
                    @if($data->rphone)
                    <div class="col-6 mb-2">
                        <p class="font-600 mb-n1 color-highlight">Phone</p>
                        <p>{{$data->rphone}}</p>
                    </div>
                    @endif
                    
                </div>
                
                
                
                
                
                
            </div>
        </div>
        @endif
        
        
       
    
       <!--<a href="{{route('login.profile')}}">-->
       <!-- <div class="card card-style profile-section">-->
       <!--     <div class="content page-profile-team">-->
       <!--         <div class="d-flex">-->
       <!--             <div><img src="{{asset('images/avatars/vbf_log.png')}}" class="me-3 rounded-circle bg-fade-red-light shadow-l" width="50"></div>-->
       <!--             <div><h5 class="mt-3 mb-0">Change Password</h5></div>-->
       <!--             <div class="ms-auto mt-3"><i class="fa fa-angle-right"></i></div>-->
       <!--         </div>-->
       <!--     </div>-->
       <!-- </div>-->
       <!-- </a>-->
        <a href="{{route('logout')}}">
        <div class="card card-style profile-section">
            <div class="content page-profile-team">
                <div class="d-flex">
                    <div><img src="{{asset('images/avatars/vbf_out.png')}}" class="me-3 rounded-circle bg-fade-red-light shadow-l" width="50"></div>
                    <div><h5 class="mt-3 mb-0">Logout</h5></div>
                    <div class="ms-auto mt-3"><i class="fa fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        </a>

@endsection

@section('footer')
@parent
@endsection

@section('footerscript')
@parent
@endsection