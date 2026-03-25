<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\News;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

use Carbon\Carbon;

class AdminController extends Controller
{

    public function dashboard()
    {
        if(Auth::guard('admin'))
        {
            $date = Carbon::now()->format('Y-m-d');
             $reports['reg'] = DB::table('customers')->where('status', 1)->paginate(10);
             $reports['count'] = DB::table('customers')->where('status', 1)->count();
             $reports['today'] = DB::table('customers')->where('created_at','like', $date.'%')->count();
             $reports['vibhag'] = DB::table('jm_blr_rs_vibhag')->orderBy('name','asc')->get();
            //  dd($reports);
            return view('admin.dashboard', compact('reports'));
        }  
    }
    public function edit_profile($id)
    {
        
         $profile = DB::table('pwa_admin')->select('*')->where('admin_id', $id)->first();
         
        return view('admin.editprofile', compact('profile'));
        
    }
    public function update_profile(Request $request, $id)
    {
        $profile['name'] =$request->name;
        $profile['email'] = $request->email;
        $profile['password'] = $request->password;
        $profile['address'] =$request->address;
        $profile['city'] = $request->city;
        $profile['country'] = $request->country;
        $profile['pin'] = $request->pincode;
        
        $profile['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/profile'), $filename);
            $profile['image']= $filename;
        }
        
       $upded = DB::table('pwa_admin')->where('admin_id', $id)->update($profile);
        
        if(!empty($upded))
        {
          return redirect()->route('adminLogout')->with ('succes', 'Updated admin details');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
    }
    public function managenews()
    {
        
        if(request()->ajax()) {
            $data = News::all();
    
            return DataTables::of($data)
        
            ->addColumn('id', function($data){
                
                if(empty($data)){
                    $id = $data->news_id;
                }else{
                $id = $data->news_id;
                }
                return $id;
            })
            ->addColumn('title',function($data){
                $title =  '<p class="text-capitalize">'.Str::limit($data->title, 20, $end='...').'</p>';
                return $title;
            })
            ->addColumn('image', function($data){
                
                $image = '<img src="'.asset('uploads/news/' . $data->image).'" class="rounded-circle" width="100" height="100">';
            
                return $image;
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
                          $button .= ' <a href="'.url('admin/news/edit/' . $data->news_id).'" class="btn btn-outline-primary-2x"><i class="icon-pencil-alt"></i></a>';
                   
                       }
                       if($resd == "Delete")
                       {
                           
                           $button .= '<a href="javascript:void(0)" data-id="'.$data->news_id.'" class="btn btn-outline-danger-2x" id="show-delete" ><i class="icon-trash" data-id="'.$data->news_id.'"></i></a>
                            ';
                       }
                       if($resd == "View"){
                            $button .= ' <a href="'.url('admin/news/view/' . $data->news_id).'" class="btn btn-outline-success-2x"><i class="fa fa-dot-circle-o"></i></a>';
                       }
                        
                   }
                
                $button .= '</div>';
                return $button;
            })
           
            ->rawColumns(['action','status','image','title','id'])
            ->addIndexColumn()
            ->make(true);
                
        }
         
        return view('admin.managenews');
        
    }
    public function addnews()
    {
         
        return view('admin.news');
        
    }
     public function news(Request $request)
    {
        $data['title'] = $request->title;
        $data['about'] = $request->about;
        $data['descp'] = $request->textbox;
        $data['status'] = $request->status ? "1" : "0";
        $data['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $data['created_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/news'), $filename);
            $data['image']= $filename;
        }

        $newsresult = DB::table('pwa_news')->insert($data);
        if(!empty($newsresult))
        {
           return redirect()->route('adminnews')->with ('succes', 'News added successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function editnews($id)
    {
        $news = News::where('news_id', $id)->first();
        return view('admin.editnews', compact('news'));
    }
    public function updatenews(Request $request, $id)
    {
        
        $news['title'] =$request->title;
        $news['about'] = $request->about;
        $news['descp'] = $request->textbox;
        $news['status'] = $request->status ? "1" : "0";
        $news['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        
        
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/news'), $filename);
            $news['image']= $filename;
        }
        
       $upded = DB::table('pwa_news')->where('news_id', $id)->update($news);
        
        if(!empty($upded))
        {
          return redirect()->route('adminnews')->with ('succes', 'updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    public function deletenews($id)
    {
        $deletd = DB::table('pwa_news')->where('news_id', $id)->delete();
        if(!empty($deletd))
        {
           return redirect()->route('adminnews')->with ('succes', 'News added successfully');
        }
        
    }
    public function viewnews($id)
    {
        $news = DB::table('pwa_news')->where('news_id', $id)->first();
        if(!empty($news))
        {
            return view('admin.viewnews', compact('news'));
        }
        
    }
}