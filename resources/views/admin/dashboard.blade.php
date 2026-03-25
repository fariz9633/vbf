@extends('admin.main')

@section('menubar_script')
@parent
<link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/chartist.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/owlcarousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/vendors/prism.css') }}">
<style>
  div.dt-buttons {
    position: relative;
    float: right;
    margin-bottom: 10px;
  }
</style>
@endsection

@section('menubar')
@parent
@endsection

@section('leftmenu')
@parent
@endsection

@section('content')

<div class="page-body">
  
  
  
  @if(\Session::get('succes'))
  <div class="position-fixed top-25 end-0 p-3 " style="z-index:1;">
    <div class="toast defaul-show-toast align-items-center text-white bg-success position-relative" aria-live="assertive" data-bs-autohide="true" aria-atomic="false">
      <div class="toast-body">{{ \Session::get('succes') }}   
        <button class="btn-close btn-close-white position-absolute top-50 end-0 translate-middle" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>
  @endif
  {{ \Session::forget('succes') }}
  
  <div class="container-fluid">    
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-6">
          <h3>Dashboard</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a class="home-item" href="{{route('admindashboard')}}"><i data-feather="home"></i></a></li>
            <li class="breadcrumb-item"> Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-12 xl-100 box-col-12">
                <div class="widget-joins card widget-arrow">
                  <div class="card-header pb-0">
                    <div class="media">
                      <div class="media-body text-start">
                        <h5>Member Approvals</h5>
                      </div>
                      
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row gy-4">
                      <div class="col-sm-6 col-md-4 col-xl-4 col-lg-6">
        <div class="card o-hidden">
          <div class="card-body">
            <div class="media static-widget">
              <div class="media-body">
                <h3 class="font-roboto">Users</h3>
                @php
                $total = DB::table('customers')->count();
                $res = DB::table('customers')->count();
                @endphp
                <h4 class="mb-0 counter">{{$res}}</h4>
              </div>
            </div>
            <div class="progress-widget">
              <div class="progress sm-progress-bar progress-animate">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4 col-xl-4 col-lg-6">
        <div class="card o-hidden">
          <div class="card-body">
            <div class="media static-widget">
              <div class="media-body">
                <h3 class="font-roboto">Members</h3>
                @php
                $total = DB::table('customers')->count();
                $res = DB::table('customers')->where('roles', 2)->where('status', 1)->count();
                @endphp
                <h4 class="mb-0 counter">{{$res}}</h4>
              </div>
            </div>
            <div class="progress-widget">
              <div class="progress sm-progress-bar progress-animate">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4 col-xl-4 col-lg-6">
        <div class="card o-hidden">
          <div class="card-body">
            <div class="media static-widget">
              <div class="media-body">
                <h3 class="font-roboto">Guests</h3>
                @php
                $res = DB::table('customers')->where('roles', 1)->where('status', 3)->count();
                @endphp
                <h4 class="mb-0 counter">{{$res}}</h4>
              </div>
              
            </div>
            <div class="progress-widget">
              <div class="progress sm-progress-bar progress-animate">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4 col-xl-4 col-lg-6">
        <div class="card o-hidden">
          <div class="card-body">
            <div class="media static-widget">
              <div class="media-body">
                <h3 class="font-roboto">Pending</h3>
                @php
                $res = DB::table('customers')->where('roles', 1)->where('status', 2)->count();
                @endphp
                <h4 class="mb-0 counter">{{$res}}</h4>
              </div>
            </div>
            <div class="progress-widget">
              <div class="progress sm-progress-bar progress-animate">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4 col-xl-4 col-lg-6">
        <div class="card o-hidden">
          <div class="card-body">
            <div class="media static-widget">
              <div class="media-body">
                <h3 class="font-roboto">Rejected</h3>
                @php
                $res = DB::table('customers')->where('roles', 1)->where('status', 1)->count();
                @endphp
                <h4 class="mb-0 counter">{{$res}}</h4>
              </div>
            </div>
            <div class="progress-widget">
              <div class="progress sm-progress-bar progress-animate">
              </div>
            </div>
          </div>
        </div>
      </div>
                    </div>
                  </div>
                </div>
              </div>
              
     <div class="col-xl-12 xl-100 box-col-12">
                <div class="widget-joins card widget-arrow">
                  <div class="card-header pb-0">
                    <div class="media">
                      <div class="media-body text-start">
                        <h5>Requirement Approvals</h5>
                      </div>
                      
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row gy-4">
                      <div class="col-sm-6 col-md-4 col-xl-4 col-lg-6">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div class="media static-widget">
                            <div class="media-body">
                                <h3 class="font-roboto">All</h3>
                                @php
                                $total = DB::table('opportunity')->count();
                                @endphp
                                <h4 class="mb-0 counter">{{$total}}</h4>
                            </div>
                            <!--<i class="fa fa-users fa-3x"></i>-->
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                                <div class="progress-gradient-primary" role="progressbar" style="width:100%" aria-valuenow="{{$total}}" aria-valuemin="0" aria-valuemax="{{$total}}"><span class="animate-circle"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-xl-4 col-lg-6">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div class="media static-widget">
                            <div class="media-body">
                                <h3 class="font-roboto">Forwarded</h3>
                                @php
                                $res = DB::table('opportunity')->where('status', 1)->count();
                                @endphp
                                <h4 class="mb-0 counter">{{$res}}</h4>
                            </div>
                            
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-xl-4 col-lg-6">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div class="media static-widget">
                            <div class="media-body">
                                <h3 class="font-roboto">Pending</h3>
                                @php
                                $res = DB::table('opportunity')->where('status', 2)->count();
                                @endphp
                                <h4 class="mb-0 counter">{{$res}}</h4>
                            </div>
                            
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-xl-4 col-lg-6">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div class="media static-widget">
                            <div class="media-body">
                                <h3 class="font-roboto">Rejected</h3>
                                @php
                                $res = DB::table('opportunity')->where('status', 3)->count();
                                @endphp
                                <h4 class="mb-0 counter">{{$res}}</h4>
                            </div>
                            
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                    </div>
                  </div>
                </div>
              </div>
    <div class="col-xl-12 xl-100 box-col-12">
                <div class="widget-joins card widget-arrow">
                  <div class="card-header pb-0">
                    <div class="media">
                      <div class="media-body text-start">
                        <h5>Business Post Approvals</h5>
                      </div>
                      
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row gy-4">
            <div class="col-sm-6 col-md-4 col-xl-4 col-lg-6">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div class="media static-widget">
                            <div class="media-body">
                                <h3 class="font-roboto">All</h3>
                                @php
                                $total = DB::table('media')->count();
                                @endphp
                                <h4 class="mb-0 counter">{{$total}}</h4>
                            </div>
                            <!--<i class="fa fa-users fa-3x"></i>-->
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                                <div class="progress-gradient-dark" role="progressbar" style="width:100%" aria-valuenow="{{$total}}" aria-valuemin="0" aria-valuemax="{{$total}}"><span class="animate-circle"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-xl-4 col-lg-6">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div class="media static-widget">
                            <div class="media-body">
                                <h3 class="font-roboto">Approved</h3>
                                @php
                                $res = DB::table('media')->where('status', 1)->count();
                                @endphp
                                <h4 class="mb-0 counter">{{$res}}</h4>
                            </div>
                            
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-xl-4 col-lg-6">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div class="media static-widget">
                            <div class="media-body">
                                <h3 class="font-roboto">Pending</h3>
                                @php
                                $res = DB::table('media')->where('status', 2)->count();
                                @endphp
                                <h4 class="mb-0 counter">{{$res}}</h4>
                            </div>
                            
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                             </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-xl-4 col-lg-6">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div class="media static-widget">
                            <div class="media-body">
                                <h3 class="font-roboto">Rejected</h3>
                                @php
                                $res = DB::table('media')->where('status', 3)->count();
                                @endphp
                                <h4 class="mb-0 counter">{{$res}}</h4>
                            </div>
                            
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-xl-4 col-lg-6">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div class="media static-widget">
                            <div class="media-body">
                                <h3 class="font-roboto">Expired</h3>
                                @php
                                $res = DB::table('media')->where('status', 4)->count();
                                @endphp
                                <h4 class="mb-0 counter">{{$res}}</h4>
                            </div>
                            
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                    </div>
                  </div>
                </div>
              </div>
              
</div>

@endsection

@section('footerbar')
@parent
@endsection


@section('footerbar_script')
@parent

<!--<script src="{{ asset('admin/assets/js/notify/bootstrap-notify.min.js') }}"></script>-->
<!--<script src="{{ asset('admin/assets/js/notify/index.js') }}"></script>-->
<!--<script src="{{ asset('admin/assets/js/height-equal.js') }}"></script>-->

<script src="{{ asset('admin/assets/js/chart/chartjs/chart.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/chart/chartist/chartist.js') }}"></script>
<script src="{{ asset('admin/assets/js/chart/chartist/chartist-plugin-tooltip.js') }}"></script>
<script src="{{ asset('admin/assets/js/chart/apex-chart/apex-chart.js') }}"></script>
<script src="{{ asset('admin/assets/js/chart/apex-chart/stock-prices.js') }}"></script>
<script src="{{ asset('admin/assets/js/prism/prism.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/counter/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/counter/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/counter/counter-custom.js') }}"></script>
<script src="{{ asset('admin/assets/js/owlcarousel/owl.carousel.js') }}"></script>
<script src="{{ asset('admin/assets/js/owlcarousel/owl-custom.js') }}"></script>
<script src="{{ asset('admin/assets/js/dashboard/dashboard_2.js') }}"></script>




<script src="{{ asset('admin/assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/datatable/datatable-extension/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/datatable/datatable-extension/jszip.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/datatable/datatable-extension/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/datatable/datatable-extension/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/datatable/datatable-extension/vfs_fonts.js') }}"></script>
<script src="{{ asset('admin/assets/js/datatable/datatable-extension/dataTables.autoFill.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/datatable/datatable-extension/dataTables.select.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/datatable/datatable-extension/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/datatable/datatable-extension/buttons.print.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/datatable/datatable-extension/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/datatable/datatable-extension/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/datatable/datatable-extension/dataTables.colReorder.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/datatable/datatable-extension/dataTables.scroller.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/datatable/datatable-extension/custom.js') }}"></script>



<script type="text/javascript">
  
  $(document).ready(function(){
    
    $('#excel-table').DataTable( {
      "dom": 'Brt',
      buttons: [ {
        extend: 'excelHtml5',
        customize: function ( xlsx ){
          var sheet = xlsx.xl.worksheets['sheet1.xml'];
          
          // jQuery selector to add a border
          $('row c[r*="10"]', sheet).attr( 's', '25' );
        }
      } ]
    } );
    
    
    var count = document.getElementById('vibhagcount');
    
    
    // vibhag chart start
    var options = {
      labels: ['BLD', 'BLU', 'HSN','KLR','MLR','MYS','SMG','TKR'],
      series: [12, 12, 12, 12, 12, 12, 12, 12],
      chart: {
        type: 'donut',
        height: 320 ,
      },
      legend:{
        position:'bottom'
      },
      dataLabels: {
        enabled: false,
      },      
      states: {          
        hover: {
          filter: {
            type: 'darken',
            value: 1,
          }
        }           
      },
      stroke: {
        width: 0,
      },
      responsive: [
      {
        breakpoint: 1661,
        options: {
          chart: {
            height:310,
          }
        }
      },            
      {
        breakpoint: 481,
        options:{
          chart:{
            height:280,
          }
        }
      }
      
      ],     
      colors:[zetaAdminConfig.primary,zetaAdminConfig.secondary,zetaAdminConfig.success,zetaAdminConfig.info,zetaAdminConfig.warning,zetaAdminConfig.danger],
    };
    var chart = new ApexCharts(document.querySelector("#vibhag-chart"), options);
    chart.render();
    // vibhag chart end
    
    
    
    // vibhag-line-chart start
    var options = {
      series: [{
        name: 'BLD',   
        data: [19, 28, 31, 25, 35, 18, 23]
      }],
      chart: {
        type: 'bar',
        height: 263,
        toolbar: {
          show: false,
        },
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '20%',
          endingShape: 'rounded'
        },
      },
      dataLabels: {
        enabled: false
      },
      legend: {
        show: false,
      },
      colors: [zetaAdminConfig.primary,zetaAdminConfig.secondary,zetaAdminConfig.success,zetaAdminConfig.info,zetaAdminConfig.warning,zetaAdminConfig.danger],
      stroke: {
        show: true,
        width: 1,
        colors: ['transparent']
      },
      states: {          
        hover: {
          filter: {
            type: 'darken',
            value: 1,
          }
        }           
      },
      xaxis: {
        colors:[zetaAdminConfig.primary,zetaAdminConfig.secondary,zetaAdminConfig.success,zetaAdminConfig.info,zetaAdminConfig.warning,zetaAdminConfig.danger],
        categories: [ 'BLD', 'BLU', 'HSN', 'KLR', 'MLR', 'MYS', 'SMG', 'TKR'],
        labels: {
          offsetX:  0,
          offsetY: -6,
          style: {
            colors: "#8E97B2",
            fontWeight: 400,
            fontSize: '10px',
            fontFamily: 'roboto'
          },
        },
        axisBorder: {
          show: false,
          
        },
        axisTicks: {
          show: false,
        },
      },
      yaxis: {   
        labels:{
          offsetX: 14,
          offsetY: -5   
        },
        tooltip: {
          enabled: true
        },
        labels: {
          formatter: function (value) {
            return value + "k";
          },
        },
      },
      fill: {
        opacity: 1
      }, 
      tooltip: {
        y: {
          formatter: function (val) {
            return  val 
          }
        }
      },
      states: {          
        hover: {
          filter: {
            type: 'darken',
            value: 1,
          }
        }           
      },
    };
    
    var chart = new ApexCharts(document.querySelector("#vibhag-line-chart"), options);
    chart.render();
    
    // vibhag-line-chart end                   
    
    
    
    
  });
</script>


@endsection