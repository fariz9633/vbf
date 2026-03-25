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
            <h5>Add Roles & Permissions</h5>
          </div>
          <div class="card-body add-post">
            <form class="row needs-validation " novalidate="" method="post" action="{{route('admin.permissions.store')}}" enctype='multipart/form-data'>
                @csrf
              <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="roles">Roles</label>
                    <select class="form-select roles" id="roles" name="roles" required="" fdprocessedid="xcyc5">
                    
                    </select>
                    <div class="invalid-feedback">Please select a role</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="modules">Modules</label>
                    <select  class="form-select modules" id="modules" name="modules" required="" fdprocessedid="xcyc5">
                    
                    </select>
                    <div class="invalid-feedback">Please select a module</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="submodules">Sub Modules</label>
                    <select class="form-select submodules" id="submodules" name="submodules" required="" fdprocessedid="xcyc5">
                    
                    </select>
                    <div class="invalid-feedback">Please select a sub module</div>
                </div>
               
                <div class="mb-3">
                  <div class="media">
                    <label class="col-form-label">Status</label>
                    <div class="media-body text-end">
                      <label class="switch">
                        <input type="checkbox" name="status"><span class="switch-state"></span>
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
        
     var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            
            
            //roles
        
        $.ajax({
            url: '{{route('roles.list')}}',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) 
            { 
                if(data == '')
                {
                }
                else
                {
                    $(".roles").append("<option label='Please Select' value=''>Select any one</option>");
                    $.each(data, function(i, item)
                    {
                        $(".roles").append("<option value="+item.id+">"+item.name+"</option>");      
                    });
                }
            }
        }); 
        
        
        //modules  
            $.ajax({
            url: '{{route('modules.list')}}',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) 
            { 
                if(data == '')
                {
                }
                else
                {
                    $(".modules").html('');
                    $(".modules").append("<option label='Please Select' value=''>Select</option>");
                    $.each(data, function(i, item)
                    {
                        $(".modules").append("<option value="+item.id+">"+item.name+"</option>");      
                    });
                    
                }
            }
        });
        
        //sub modules
        $('.modules').on('change', function()
        {

                $.ajax({
                    url: '{{route('submodules.list')}}',
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, modules:$(this).val()},
                    dataType: 'JSON',
                    success: function (data) 
                    { 
                        $(".submodules").html('');
                        $(".submodules").append("<option label='Please Select' value=''>Select a Module</option>");
                        
                        
                        
                        if(data == '')
                        {
                            
                            
                        }
                        else
                        {
                            $(".submodules").html('');
                            $(".submodules").append("<option label='Please Select' value=''>Select </option>");
                            $.each(data, function(i, item)
                            {
                                $(".submodules").append("<option value="+item.id+">"+item.name+"</option>");      
                            });
                        }
                    }
                });
        });
        
        
    });
    
</script>

@endsection