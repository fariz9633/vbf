<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Permissions;

use App\Models\Roles;

use App\Models\Modules;

use App\Models\Submodules;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class PermissionsController extends Controller
{
    public function managepermissions()
    {
        
        if(request()->ajax()) {
            $data = Permissions::select('permissions.*', 'roles.name as rolesname', 'modules.name as modulesname', 'submodules.name as submodulesname')
            ->join('roles', 'roles.id', '=', 'permissions.roles', 'left')
            ->join('modules', 'modules.id', '=', 'permissions.modules', 'left')
            ->join('submodules', 'submodules.id', '=', 'permissions.submodules', 'left')
            ->get();
    
            return DataTables::of($data)
        
            ->addColumn('id', function($data){
                
                if(empty($data)){
                    $id = $data->id;
                }else{
                $id = $data->id;
                }
                return $id;
            })
            ->addColumn('rolesname', function($data){
                
                if(empty($data)){
                    $rolesname = $data->rolesname;
                }else{
                $rolesname = $data->rolesname;
                }
                return $rolesname;
            })
            ->addColumn('modulesname', function($data){
                
                if(empty($data)){
                    $modulesname = $data->modulesname;
                }else{
                $modulesname = $data->modulesname;
                }
                return $modulesname;
            })
            
            ->addColumn('submodulesname', function($data){
                
                if(empty($data)){
                    $submodulesname = $data->submodulesname;
                }else{
                $submodulesname = $data->submodulesname;
                }
                return $submodulesname;
            })
            
            ->addColumn('name',function($data){
                $name =  '<p class="text-capitalize">'.$data->name.'</p>';
                return $name;
            })
            
            ->addColumn('status', function($data){
    
                    if($data->status != null){

                        if($data->status == 1){
                                $status = '<span class="badge badge-success"> Activated</span>';
            
                            }
                           
                            else{
                                $status = '<span class="badge badge-danger">Not Activated</span>';
                            }
            
                            return $status;

                    }
                    
                })
            ->addColumn('action', function($data){
    
                $button = '<div class = "">';
                
                  $rolid = session('admin.admin_id');
                $rol = DB::table('pwa_user_capabilities')->where('admin_id', $rolid)->first();
                $va = explode(',', $rol->name);
                  
                   foreach($va as $resd)
                   {
                       if($resd == "Edit")
                       {
                         $button .= ' <a href="'.url('admin/permissions/edit/' . $data->id).'" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>';
                   
                       }
                       if($resd == "Delete")
                       {
                           
                           $button .= '<a href="'.url('admin/permissions/delete/' . $data->id).'" class="btn btn-outline-danger-2x"><i class="icon-trash" ></i></a>
                            ';
                       }
                      
                        
                   }
                
                          
                           
                
                $button .= '</div>';
                return $button;
            })
           
            ->rawColumns(['action','status','rolesname','modulesname','submodulesname','id'])
            ->addIndexColumn()
            ->make(true);
                
        }
         
        return view('admin.managepermissions');
        
    }
    public function addpermissions()
    {
        return view('admin.permissions');
    }
     public function permissions(Request $request)
    {
        $data['roles'] = $request->roles;
        $data['modules'] = $request->modules;
        $data['submodules'] = $request->submodules;
        $data['status'] = $request->status ? "1" : "0";
       
        $permissionsresult = DB::table('permissions')->insert($data);
        if(!empty($permissionsresult))
        {
           return redirect()->route('adminpermissions')->with ('succes', 'New Roles & Permissions added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editpermissions($id)
    {
        $permissions = Permissions::where('id', $id)->first();
        $permissions['det'] = Permissions::where('id', $id)->first();
        $permissions['roles'] = Roles::all();
        $permissions['modules'] = Modules::all();
        $permissions['submodules'] = Submodules::all();
        return view('admin.editpermissions', compact('permissions'));
    }
    public function updatepermissions(Request $request, $id)
    {
        
        $permissions['roles'] = $request->roles;
        $permissions['modules'] = $request->modules;
        $permissions['submodules'] = $request->submodules;
        $permissions['status'] = $request->status ? "1" : "0";
        
       $upded = DB::table('permissions')->where('id', $id)->update($permissions);
        
        if(!empty($upded))
        {
          return redirect()->route('adminpermissions')->with ('succes', 'Roles & Permissions updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deletepermissions($id)
    {
        $deletd = DB::table('permissions')->where('id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('adminpermissions')->with ('succes', 'Roles & Permissions deleted successfully');
        }
        
    }
    
}