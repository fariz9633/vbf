@extends('admin.main')

@section('menubar_script')
@parent
<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/dropzone.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.9.2/ckeditor.js"></script>
 <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/select2.css')}}">
@endsection

@section('menubar')
@parent
@endsection

@section('leftmenu')
@parent
@endsection

@section('content')
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-6">
          <h3>Roles & Permissions</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{route('admindashboard')}}">                                       
                <i data-feather="home"></i>
              </a>
            </li>
            <li class="breadcrumb-item">Roles & Permissions</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header pb-0">
            <h5>Edit Roles & Permissions</h5>
          </div>
          <div class="card-body add-post">
            <form class="row needs-validation " novalidate="" method="post" action="{{route('admin.permissions.update', ["id"=>$permissions['det']->id])}}" enctype='multipart/form-data'>
                @csrf
                @method('PUT')
              <div class="row">
               
                <div class="col-md-6 mb-3">
                          <label class="form-label" for="validationCustom04">Roles</label>
                          <select class="form-select" id="validationCustom04" name="roles" required>
                            <option selected disabled="" value="">Select</option>
                            @foreach($permissions['roles'] as $roles)
                             @php 
                             $rolessel = ($roles->id == $permissions['det']->roles)?"selected":"";
                             @endphp
                            <option value="{{$roles->id}}" <?=$rolessel;?>>{{$roles->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        
                <div class="col-md-6 mb-3">
                          <label class="form-label" for="validationCustom04">Modules</label>
                          <select class="form-select" id="validationCustom04" name="modules" required>
                            <option selected disabled="" value="">Select</option>
                            @foreach($permissions['modules'] as $modules)
                             @php 
                             $modulessel = ($modules->id == $permissions['det']->modules)?"selected":"";
                             @endphp
                            <option value="{{$modules->id}}" <?=$modulessel;?>>{{$modules->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                          <label class="form-label" for="validationCustom04">Sub Modules</label>
                          <select class="form-select" id="validationCustom04" name="submodules" required>
                            <option selected disabled="" value="">Select</option>
                            @foreach($permissions['submodules'] as $submodules)
                             @php 
                             $submodulessel = ($submodules->id == $permissions['det']->submodules)?"selected":"";
                             @endphp
                            <option value="{{$submodules->id}}" <?=$submodulessel;?>>{{$submodules->name}}</option>
                            @endforeach
                          </select>
                        </div>
               
               
                <div class="mb-3">
                  <div class="media">
                    <label class="col-form-label">Status</label>
                    <div class="media-body text-end">
                      <label class="switch">
                          @php
                          $chk = $permissions['det']->status == '1' ? "checked" : " ";
                          @endphp
                          
                          <input type='checkbox' name='status' <?=$chk;?> >
                         
                        <span class="switch-state"></span>
                      </label>
                    </div>
                  </div>
                </div>    
              </div>
              <div class="btn-showcase text-end">
                <input class="btn btn-primary" type="submit" value="Submit">
                <input class="btn btn-light" type="reset" value="Cancel">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->
</div>

@endsection

@section('footerbar')
@parent
@endsection


@section('footerbar_script')
@parent

<script src="{{asset('admin/assets/js/dropzone/dropzone.js')}}"></script>
<script src="{{asset('admin/assets/js/dropzone/dropzone-script.js')}}"></script>
<script src="{{asset('admin/assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('admin/assets/js/select2/select2-custom.js')}}"></script>
<script src="{{asset('admin/assets/js/email-app.js')}}"></script>
<script src="{{asset('admin/assets/js/form-validation-custom.js')}}"></script>


 <script src="{{asset('admin/assets/js/select2/select2.full.min.js')}}"></script>
 
 
 <script type="text/javascript">

    $(document).ready(function(){
        
        $(".form-select").select2({
          placeholder : "Select",
          tags: true,
           minimumResultsForSearch: Infinity

      });
    });
    </script>

@endsection