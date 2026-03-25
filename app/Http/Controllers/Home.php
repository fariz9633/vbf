<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Customer;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use Stevebauman\Location\Facades\Location;

use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Str;

use GuzzleHttp\Client as Guzle;

use Carbon\Carbon;

use Response;

use Illuminate\Support\Facades\Http;

use App\Mail\NotifyMail;

use Illuminate\Support\Facades\Mail;


class Home extends Controller
{
   
    public function form(){
        
        return view('includes.otplogin');
    }
    public function generate(Request $request)
    {
        $user =  DB::table('customers')->where('phone', $request->phone)->first();
        
        if(empty($user)){
            
        $otp =  mt_rand(0, 9999);
        $client = new Guzle();
        
        $workingKey = 'Ab03e3e01101171ea663244197610958f';
        $sender = 'VIIPRA';
        $to = $request->phone;
        $message = 'OTP for registration on V Biz is'.$otp.'Vipra Business Forum';
        $templateid = '1207164536019748952';
        
        
        $url = 'http://map-alerts.smsalerts.biz/api/web2sms.php';
        $params = [
            'query' => [
                'workingkey' => $workingKey,
                'sender' => $sender,
                'to' => $to,
                'message' => $message,
                'template id' => $templateid
            ]
        ];
        $response = $client->get($url, $params);
        
        // $content = $response->getBody()->getContents();
        
        $status_code = $response->getStatusCode();
        if($status_code == '200'){
            
            //check otp pending
            // DB::table('customer_otp')->where('cust_id', $user->id)->delete();
            
            $upd['cust_id'] = $request->phone;
            $upd['otp'] = $otp;
            $upd['created_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            
            $userOtp = DB::table('customer_otp')->insertGetId($upd);
            
            return redirect()->route('otp.verify', ['id' => encrypt($userOtp)]); 
            
            // return redirect()->route('otp.verify')->with('success', 'OTP Sended successfully.');
            
        }
            
        }
        else{
            Session::put('error', 'Mobile number already registered');
            // return redirect()->route('otp.register')->with('error', 'Mobile number already registered');
            // return redirect()->route('otp.register');
             return view('includes.otplogin')->with('error', 'Mobile number already registered');
        }
        
        
    }
    public function logincalenderdetails($id)
    {
        $find = "EVENTS";
        $chkval = Str::contains($id, $find);
        if($chkval){
            //events
            $events =  DB::table('pwa_events')->where('eid', $id)->first();
            return redirect()->route('login.events.detail', ['id'=>$events->events_id]);
        }
        else{
            //meetings
            $meetings =  DB::table('pwa_meetings')->where('eid', $id)->first();
            return redirect()->route('login.meetings.detail', ['id'=>$meetings->id]);
        } 
        
    }
    
    public function enquirystore(Request $request)
    {
        $data['cust_id'] = Auth::guard('customer')->id();
        $data['opportunitytype'] = $request->input('opportunitytype');
        $data['referalstatus'] = $request->input('referalstatus');
        $data['referencetype'] = $request->input('referencetype');
        $data['descp'] = $request->input('descp');
        $data['phone'] = $request->input('phone');
        $data['name'] = $request->input('name');
        $data['member'] = $request->input('member');
        $data['created_at'] = date('Y-m-d H:i:s');
        // dd($data);
        if(Auth::guard('customer')->user()->roles == 1){
           
        // $data['chapter'] = Auth::guard('customer')->user()->category;
        $data['status'] = 2;
        }
        else if(Auth::guard('customer')->user()->roles == 2)
        {
            
            if($request->input('opportunitytype') == 4)
            {
                $data['category'] = NULL;
                $data['member'] = NULL;
                $data['status'] = 2;
                
            }
            // else
            // {
            //     $data['chapter'] = $request->input('chapter');
            // }
            
        }
       
        // dd($data);
        $result =  DB::table('opportunity')->insert($data);

        if(!empty($result))
        {
            return redirect()->route('login.media.list')->with('success', 'Your requirement is noted, Our registered member will reach you soon');
        }
        else
        {
            return redirect()->route('login.enquiry.add')->with('error', 'Something wrong & invalid');
        }
    
    }
    public function enquiryadd($id)
    {
        if(Auth::guard('customer')->check())
        {
        $enquiry =  DB::table('customers')->where('id', $id)->first();
        // dd($enquiry);
            return view('includes.addenquiry', compact('enquiry')); 
        }
        else{
            return redirect()->route('login');
        }
    }
   
    public function terms()
    {
        return view('includes.terms');
    }

    public function verifymobile(Request $request)
    {

        $details =  DB::table('customers')->where('phone', $request->input('phone'))->get();
        
        return view('includes.checkstatus', compact('details'));

        // if(!empty($chkexist))
        // {
        //     return redirect()->route('checkstatus')->with('error', 'Already Registered');
        // }
        // else
        // {
        //     return redirect()->route('checkstatus')->with('success', 'It is not registered, Kindly register');
        // }
    }
    
    public function checkstatus()
    {
        return view('includes.checkstatus');  
    }

    public function index()
    {
        if(Auth::guard('customer')->check())
        {
        
        $dash['banner'] = DB::table('pwa_banner')->select('*')->where('status',1)->get();
        $dash['news'] = DB::table('pwa_news')->select('*')->where('status',1)->get();
        $dash['activities'] = DB::table('pwa_activities')->select('*')->where('status',1)->get();
        $dash['updates'] = DB::table('pwa_updates')->select('*')->where('status',1)->get();
        $dash['events'] = DB::table('pwa_events')->select('*')->where('status',1)->limit('1')->first();
        $dash['scheme'] = DB::table('pwa_scheme')->select('*')->where('status',1)->get();
        $dash['about'] = DB::table('pwa_about')->select('*')->where('status',1)->get();
        $dash['content'] = DB::table('pwa_content')->select('*')->where('status',1)->limit('1')->first();
        $dash['services'] = DB::table('pwa_services')->select('*')->where('status',1)->get();
        
         $dash['past'] =  DB::table('pwa_meetings')
         ->where('date','<', \Carbon\Carbon::today()->format('m/d/Y'))
        //  ->where('time','<', \Carbon\Carbon::today()->format('H:i'))
         ->where('status', 1)->get();
            $dash['new'] =  DB::table('pwa_meetings')
            ->where('date','=', \Carbon\Carbon::today()->format('m/d/Y'))
            // ->where('time','>=', \Carbon\Carbon::today()->format('H:i'))
            ->where('status', 1)
            ->get();
            $dash['upcoming'] =  DB::table('pwa_meetings')
            ->where('date','>', \Carbon\Carbon::today()->format('m/d/Y'))
            // ->where('time','>', \Carbon\Carbon::today()->format('H:i'))
            ->where('status', 1)->get();
            
            // echo \Carbon\Carbon::today()->format('H:i');
            // dd( $dash['new']);
            
        return view('includes.index', compact('dash'));
        }
        else{
            return view('includes.login'); 
        }
    }

    public function register($id)
    {
        $details['number'] = decrypt($id);
        
        return view('includes.register', compact('details'));
        
        // return view('includes.register');  
    }

    public function registerstore(Request $request)
    {
        
        if(Auth::guard('customer')->user())
        {
            //Become a Member form
            $id = Auth::guard('customer')->user()->id;
            
            
                $data['category'] = $request->input('category');
                $data['subcategory'] = $request->input('subcategory');
                $data['chapter'] = $request->input('chapter');
                $data['descp'] = $request->input('descp');
                $data['keyword'] = $request->input('keyword');
                $data['state'] = $request->input('state');
                $data['country'] = $request->input('country');
                
                
                
                 $data['gender'] = $request->input('gender');
                 if($request->input('email')){
                $data['email'] = $request->input('email');
                     
                 }
                $data['address'] = $request->input('address');
                $data['dob'] = $request->input('dob');
                $data['martial'] = $request->input('martial');
                 $data['martial_date'] = $request->input('martial_date');
                $data['gotra'] = $request->input('gotra');
                $data['paddress'] = $request->input('paddress');
                
                $data['bname'] = $request->input('bname');
                $data['baddress'] = $request->input('baddress');
                $data['bdate'] = $request->input('bdate');
                $data['designation_id'] = $request->designation_id;
                $data['nature'] = $request->nature;
                $data['bphone'] = $request->bphone;
                $data['bemail'] = $request->bemail;
                $data['website'] = $request->website;
                $data['idproof'] = $request->idproof;
                $data['gst'] = $request->gst;
                $data['pan'] = $request->pan;
                $data['others'] = $request->others;
                
                $data['rname'] = $request->rname;
                $data['rmem'] = $request->rmem;
                $data['rphone'] = $request->rphone;
                $data['remail'] = $request->remail;
                
                $data['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
                $data['status'] = '2';
                
                if($request->file('profile'))
                {
                $file= $request->file('profile');
                $filename= "prof".date('YmdHis').$file->getClientOriginalName();
                $file-> move(public_path('uploads/customer'), $filename);
                $data['profile']= $filename;
                }
                
                if($request->file('idimage'))
                {
                $file= $request->file('idimage');
                $filename= "idimage".date('YmdHis').$file->getClientOriginalName();
                $file-> move(public_path('uploads/customer'), $filename);
                $data['idimage']= $filename;
                }
                if($request->file('idaddress'))
                {
                $file= $request->file('idaddress');
                $filename= "idaddress".date('YmdHis').$file->getClientOriginalName();
                $file-> move(public_path('uploads/customer'), $filename);
                $data['idaddress']= $filename;
                }
                if($request->file('breg'))
                {
                $file= $request->file('breg');
                $filename= "breg".date('YmdHis').$file->getClientOriginalName();
                $file-> move(public_path('uploads/customer'), $filename);
                $data['breg']= $filename;
                }
                
               
                if($request->file('gstcer'))
                {
                $file= $request->file('gstcer');
                $filename= "gstcer".date('YmdHis').$file->getClientOriginalName();
                $file-> move(public_path('uploads/customer'), $filename);
                $data['gstcer']= $filename;
                }
                
               
                if($request->file('panimage'))
                {
                $file= $request->file('panimage');
                $filename= "panimage".date('YmdHis').$file->getClientOriginalName();
                $file-> move(public_path('uploads/customer'), $filename);
                $data['panimage']= $filename;
                }
                
                if($request->file('doc'))
                {
                $file= $request->file('doc');
                $filename= "doc".date('YmdHis').$file->getClientOriginalName();
                $file-> move(public_path('uploads/customer'), $filename);
                $data['doc']= $filename;
                }
                
                if($request->file('signature'))
                {
                $file= $request->file('signature');
                $filename= "signature".date('YmdHis').$file->getClientOriginalName();
                $file-> move(public_path('uploads/customer'), $filename);
                $data['signature']= $filename;
                }
                
                
                
                
               
            $updatas =  DB::table('customers')->where('id', $id)->update($data);
             if($updatas)
             {
                return redirect()->route('dashboard')->with('success','VBF Team will update you soon...');
             }
            
        }
        
        else
        {
            //registration
            
            $chkexist =  DB::table('customers')->where('phone', $request->input('phone'))->first();
    
            if(!empty($chkexist))
            {
                return redirect()->route('otp.register')->with('error', 'Mobile number already registered');
            }
            else
            {
                
                $data['pincode'] = $request->input('pincode');
                $data['username'] = $request->input('name');
                $data['email'] = $request->input('email');
                $data['phone'] = $request->input('phone');
                $data['password'] = Hash::make($request->password);
                $data['created_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
                $data['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
                $data['roles'] = 1;
                $data['status'] = '3';
                
                if($request->file('profile'))
                {
                    $file= $request->file('profile');
                    $filename= "prof".date('YmdHis').$file->getClientOriginalName();
                    $file-> move(public_path('uploads/customer'), $filename);
                    $data['profile']= $filename;
                }
            
                
                
                // elseif( $request->input('roles') == 2)
                // {
                    
                //     $data['username'] = $request->input('name');
                //     $data['email'] = $request->input('email');
                //     $data['phone'] = $request->input('phone');
                //     $data['password'] = Hash::make($request->password);
                //     $data['roles'] = $request->input('roles');
                    
                //     if($request->file('profile'))
                //     {
                //     $file= $request->file('profile');
                //     $filename= "prof".date('YmdHis').$file->getClientOriginalName();
                //     $file-> move(public_path('uploads/customer'), $filename);
                //     $data['profile']= $filename;
                //     }
                    
                    
                    
                //     $data['address'] = $request->input('address');
                //     $data['dob'] = $request->input('dob');
                //     $data['martial'] = $request->input('martial');
                //     $data['martial_date'] = $request->input('martial_date');
                //     $data['gotra'] = $request->input('gotra');
                //     $data['paddress'] = $request->input('paddress');
                //     $data['bname'] = $request->input('bname');
                //     $data['baddress'] = $request->input('baddress');
                //     $data['bdate'] = $request->input('bdate');
                //     $data['designation_id'] = $request->designation_id;
                //     $data['nature'] = $request->nature;
                //     $data['bphone'] = $request->bphone;
                //     $data['bemail'] = $request->bemail;
                //     $data['website'] = $request->website;
                //     $data['idproof'] = $request->idproof;
                //     $data['status'] = '3';
                    
                //     if($request->file('idimage'))
                //     {
                //     $file= $request->file('idimage');
                //     $filename= "idimage".date('YmdHis').$file->getClientOriginalName();
                //     $file-> move(public_path('uploads/customer'), $filename);
                //     $data['idimage']= $filename;
                //     }
                //     if($request->file('idaddress'))
                //     {
                //     $file= $request->file('idaddress');
                //     $filename= "idaddress".date('YmdHis').$file->getClientOriginalName();
                //     $file-> move(public_path('uploads/customer'), $filename);
                //     $data['idaddress']= $filename;
                //     }
                //     if($request->file('breg'))
                //     {
                //     $file= $request->file('breg');
                //     $filename= "breg".date('YmdHis').$file->getClientOriginalName();
                //     $file-> move(public_path('uploads/customer'), $filename);
                //     $data['breg']= $filename;
                //     }
                    
                //     $data['gst'] = $request->gst;
                //     if($request->file('gstcer'))
                //     {
                //     $file= $request->file('gstcer');
                //     $filename= "gstcer".date('YmdHis').$file->getClientOriginalName();
                //     $file-> move(public_path('uploads/customer'), $filename);
                //     $data['gstcer']= $filename;
                //     }
                    
                //     $data['pan'] = $request->pan;
                //     if($request->file('panimage'))
                //     {
                //     $file= $request->file('panimage');
                //     $filename= "panimage".date('YmdHis').$file->getClientOriginalName();
                //     $file-> move(public_path('uploads/customer'), $filename);
                //     $data['panimage']= $filename;
                //     }
                //     $data['others'] = $request->others;
                //     if($request->file('doc'))
                //     {
                //     $file= $request->file('doc');
                //     $filename= "doc".date('YmdHis').$file->getClientOriginalName();
                //     $file-> move(public_path('uploads/customer'), $filename);
                //     $data['doc']= $filename;
                //     }
                //     $data['rname'] = $request->rname;
                //     $data['rmem'] = $request->rmem;
                //     $data['rphone'] = $request->rphone;
                //     $data['remail'] = $request->remail;
                //     if($request->file('signature'))
                //     {
                //     $file= $request->file('signature');
                //     $filename= "signature".date('YmdHis').$file->getClientOriginalName();
                //     $file-> move(public_path('uploads/customer'), $filename);
                //     $data['signature']= $filename;
                //     }
                    
                    
                    
                // }
                
                    $data['category'] = $request->input('category');
                    $data['subcategory'] = $request->input('subcategory');
                    $data['chapter'] = $request->input('chapter');
                    $data['descp'] = $request->input('descp');
                    $data['keyword'] = $request->input('keyword');
                    $data['city'] = $request->input('city');
                    $data['state'] = $request->input('state');
                    $data['country'] = $request->input('country');
                    
                   
    
                
                $cstresult = DB::table('customers')->insert($data);
                 
                
                $v =  DB::getPdo()->lastInsertId();
                $upd['reg_id'] = "VBF0000".$v;
                DB::table('customers')->where('id', $v)->update($upd);
                
                if($cstresult)
                {
                    // if($data['roles'] == 2)
                    // {
                    //     return redirect()->route('register', ['id' =>$request->input('phone')])->with('success','Registered successfully!!');
                    // }
                    // else{
                    return redirect()->route('login')->with('success','Registered successfully!!');
                    // }
                }
                // else
                // {
                //     Session::flash('error','Exist this email or phone'); 
                //     return redirect()->route('register')->with('error', 'Invalid inputs you entered');
                // }
            }
        
        }

    }

    public function dashboard()
    {
        $dashactive1 = "active-nav";
        return view('includes.index', compact('dashactive1')); 
    }

    public function maintanence()
    {
        return view('includes.maintanence');
    }

    public function logout()
    {
        Auth::logout();
       
        $upid = Auth::guard('customer')->user()->id;
        $user = DB::table('customers_logs')->where('custid', $upid)->first();
        if(!empty($user)){
        
            $updata['logout'] = date('Y-m-d H:i:s');
            DB::table('customers_logs')->where('custid',$upid)->update($updata);
        }
        Auth::guard('customer')->logout();
        return redirect()->route('login')->with('success','You account has been logged out successfully!');
    }

    public function forgotpassword()
    {
        return view('includes.forgot-password');  
    }
    public function forgotstore(Request $request)
    {
        $chkphone =  DB::table('customers')->where('phone', $request->input('phone'))->first();
        if(!empty($chkphone))
        {
            $phone = $request->input('phone');
            return view('includes.confirm-password', compact('phone'));  
                
        }
        else
        {
            return redirect()->route('forgot-password')->with('error', 'You entered phone number not registered');
        }
    }
    public function forgotpasswordstore(Request $request)
    {
        $chkphone =  DB::table('customers')->where('phone', $request->input('phone'))->first();
        if(!empty($chkphone))
        {
            $phone = $request->input('phone');
            
            $otp = mt_rand(100000, 999999);
            $client = new Guzle();
            
            $workingKey = 'Ab03e3e01101171ea663244197610958f';
            $sender = 'VBFSMS';
            $to = $phone;
            $message = 'Your OTP for the Change of Password is '.$otp.', For any help call on 9606274007 Virpa Business Forum';
            $templateid = '1207168898501710207';
            
            
            
            $url = 'http://map-alerts.smsalerts.biz/api/web2sms.php';
            $params = [
            'query' => [
            'workingkey' => $workingKey,
            'sender' => $sender,
            'to' => $to,
            'message' => $message,
            'template id' => $templateid
            ]
            ];
            $response = $client->get($url, $params);
            
            $status_code = $response->getStatusCode();
            if($status_code == '200'){
            
            //check otp pending
            // DB::table('customer_otp')->where('cust_id', $user->id)->delete();
            
            $upd['cust_id'] = $phone;
            $upd['otp'] = $otp;
            $upd['created_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            
            $userOtp = DB::table('customer_otp')->insertGetId($upd);
            if(!empty($userOtp)){
                
                
                // echo $recipientPhoneNumber = $phone;
                // echo $smsContent = "your registered mobile number is" . $phone . "<br>\n ".$message;
                // echo $to = "mohammedaris161@gmail.com";
                // $emailsts = Mail::to($to)->send(new NotifyMail($phone, $smsContent, $sender));
                
                // $emailsts = Mail::to($to)->send(new NotifyMail());

                // dd($emailsts);
                
                return redirect()->route('otp.forgotverify', ['id' => encrypt($userOtp)]); 
                
            }
            
            
            
            // return redirect()->route('otp.verify')->with('success', 'OTP Sended successfully.');
            
            }
            return view('includes.confirm-password', compact('phone'));  
                
        }
        else
        {
            return redirect()->route('forgot-password')->with('error', 'You entered phone number not registered');
        }
    }
    public function forgotverify(Request $request , $id){
        
        $details['id'] = decrypt($id);
        
        if ($request->session()->has('error')) {
            
            $value = $request->session()->get('error');
            return view('includes.forgotverify', compact('details'))->with('error', $value);
        }
        
        return view('includes.forgotverify', compact('details'));
    }
    public function forgotverifyOtp(Request $request)
{
    
    $code = $request->otp;
    $id = $request->id;
    
    $result = DB::table('customer_otp')->where('id', $id)->where('otp', $code)->first();
    
    
    
    
    if(!empty($result)) {
        $phone = $result->cust_id;
        
        return view('includes.confirm-password', compact('phone'));  
        
            
    } else {
        
        return redirect()->route('otp.forgotverify', ['id' => encrypt($id)])->with('error', 'Invalid OTP');
    }
}
    
    public function confirmpasswordstore(Request $request)
    {
       $data['password'] = Hash::make($request->password);
       DB::table('customers')->where('phone', $request->input('phone'))->update($data);
       
       return redirect()->route('login')->with('success', 'Password Changed');
       
   }
   
    public function loginind()
    {
        // if(Auth::guard('customer')->check())
        // {
        //     return redirect()->back();
        // }
        // else{
            return view('includes.login'); 
        // }
    }
    
    public function login(Request $request)
    {
    $chkphone =  DB::table('customers')->where('phone', $request->input('phone'))->where('password', Hash::check('plain-text', $request->input('password')))->first();

    if(!empty($chkphone))
    {

        if(Hash::check($request->input('password'),$chkphone->password))
        {
            $credentials = $request->only('phone', 'password');
            // dd($credentials);
            if(Auth::guard('customer')->attempt($credentials))
            {
                //customer login session
                $dat = Auth::guard('customer')->user();
                $request->session()->put('customers' , $dat);
                $request->session()->save();
                
                //customer logs
                $updata['custid'] = Auth::guard('customer')->user()->id;
                $updata['login'] = date('Y-m-d H:i:s');
                $updata['ip'] = $request->ip();
                DB::table('customers_logs')->insert($updata);
                
                
                
                //check
                $chcknotif = DB::table('customer_notification')->where('custid', Auth::guard('customer')->user()->id)->where('status', 2)->first();
                
                if(!empty($chcknotif)){
                    
                    $not['status'] = 1;
                    DB::table('customer_notification')->where('custid', Auth::guard('customer')->user()->id)->update($not);
                    
                return redirect()->route('login.dashboard')->with('success','Welcome to VBF MemberShip Account');
                }
                else{
                  
                        if($chkphone->roles == 2){
                return redirect()->route('login.dashboard')->with('success','Your account has been logged in successfully!');
                
                }
                        else{
                return redirect()->route('login.media.list')->with('success','Your account has been logged in successfully!');
                
                }
            }
            
                
            }
            else
            {
                return redirect()->route('login');
            } 
        }
        else
        {
            return redirect()->route('login')->with('error','Incorrect password');
        }
    }
    else
    {
        return redirect()->route('login')->with('error','Mobile number already registered'); 
    }

}
    
    public function logindashboard()
    {
        if(Auth::guard('customer')->check())
        {
            // dd(Auth::guard('customer')->user()->roles);
            
            if(Auth::guard('customer')->user()->roles == 1)
            {
               return redirect()->route('dashboard');
                
            }
            elseif(Auth::guard('customer')->user()->roles == 2){
                
                 $id = Auth::guard('customer')->id();
                 $chap = Auth::guard('customer')->user()->category;
                 $data['given'] = DB::table('opportunity')->select('opportunity.*')
        ->where('opportunity.cust_id',$id)
        // ->where('opportunity.category', $chap)
        ->where('opportunity.status', 1)
        ->count();
        
        
        
        
        $data['received'] = DB::table('opportunity')->select('opportunity.*')
        ->where('opportunity.cust_id','!=',$id)
        ->where('opportunity.category', $chap)
        ->orWhere('opportunity.member', '=', $id)
        ->where('opportunity.status', 1)
        ->count();
        
        $data['total'] = DB::table('pwa_meetings')
        ->where('status', 1)
        ->count();
        
        $data['attended'] = DB::table('pwa_meetings_attendance')->where('custid', $id)
        ->where('status', 1)
        ->count();
        
            return view('includes.dashboard', compact('data')); 
                
            }
            
            
        }
        else{
            return redirect()->route('login');
        }
    }
    public function loginevents()
    {
        if(Auth::guard('customer')->check())
        {
            $events =  DB::table('pwa_events')->where('status', 1)->get();
        
        return view('includes.events', compact('events')); 
        }
        else{
            return redirect()->route('login');
        }
    }
    public function logineventsdetails($id)
    {
        if(Auth::guard('customer')->check())
        {
            $events =  DB::table('pwa_events')->where('events_id', $id)->first();
            return view('includes.eventsdetail', compact('events')); 
        }
        else{
            return redirect()->route('login');
        }
    }
    public function loginmeetings()
    {
        if(Auth::guard('customer')->check())
        {
           
           
            $meetings['past'] =  DB::table('pwa_meetings')->where('date','<', \Carbon\Carbon::today()->format('m/d/Y'))->where('status', 1)->get();
            $meetings['new'] =  DB::table('pwa_meetings')->where('date','=', \Carbon\Carbon::today()->format('m/d/Y'))->where('status', 1)->get();
            $meetings['upcoming'] =  DB::table('pwa_meetings')->where('date','>', \Carbon\Carbon::today()->format('m/d/Y'))->where('status', 1)->get();
           
        
        return view('includes.meetings', compact('meetings')); 
        }
        else{
            return redirect()->route('login');
        }
    }
    public function loginmeetingsdetails($id)
    {
        if(Auth::guard('customer')->check())
        {
            $meetings =  DB::table('pwa_meetings')->where('id', $id)->first();
            return view('includes.meetingsdetail', compact('meetings')); 
        }
        else{
            return redirect()->route('login');
        }
    }
    
    public function loginnews()
    {
        if(Auth::guard('customer')->check())
        {
             $news =  DB::table('pwa_news')->where('status', 1)->get();
        return view('includes.news', compact('news')); 
        }
        else{
            return redirect()->route('login');
        }
    }
    
    public function loginnewsdetail($id)
    {
        if(Auth::guard('customer')->check())
        {
            $news =  DB::table('pwa_news')->where('news_id', $id)->first();
            return view('includes.newsdetail', compact('news')); 
        }
        else{
            return redirect()->route('login');
        }
    }
    
    public function logincalender()
    {
        if(Auth::guard('customer')->check())
        {
             $calender =  DB::table('calender')->where('status', 1)->get();
            //  $calender = DB::table('calender')
            //  ->select('pwa_meetings.id as meetid','pwa_events.events_id as eveid', 'calender.*')
            //  ->join('pwa_meetings', 'pwa_meetings.eid', '=', 'calender.eid')
            //  ->join('pwa_events', 'pwa_events.eid', '=', 'calender.eid')
            //  ->where('calender.status', 1)
            //  ->get();
            // dd($calender);
    
            return view('includes.calender', compact('calender')); 
        }
        else{
            return redirect()->route('login');
        }
    }
    
    public function loginprofile()
    {
        if(Auth::guard('customer')->check())
        {
        return view('includes.profile'); 
        }
        else{
            return redirect()->route('login');
        }
    }
    
    public function logingallery()
    {
        if(Auth::guard('customer')->check())
        {
            $gallery =  DB::table('pwa_gallery')->where('status', 1)->get();
        return view('includes.gallery', compact('gallery'));  
        }
    }
    
    public function loginsupport()
    {
        if(Auth::guard('customer')->check())
        {
        return view('includes.maintanence'); 
        }
        else{
            return redirect()->route('login');
        }
    }
    
    public function listmembers()
    {
        if(Auth::guard('customer')->check())
        {
        $members = Customer::select('customers.*', 'pwa_category.name as catname', 'pwa_subcategory.name as subcatname')
        ->join('pwa_category','customers.category','=', 'pwa_category.id','left')
        ->join('pwa_subcategory','customers.subcategory','=', 'pwa_subcategory.id','left')
        ->where('customers.roles', 2)
        ->where('customers.status', 1)->get();
        // $members = Customer::all();
        return view('includes.listmembers', compact('members'));  
    }
        else{
            return view('includes.login'); 
        }
    }
    
    public function memberdetails($id)
    {
        if(Auth::guard('customer')->check())
        {
        $memberdetails = Customer::select('customers.*')
        
    //    $memberdetails = Customer::select('customers.*', 'pwa_category.name as catname', 'pwa_subcategory.name as subcatname', 'pwa_chapter.name as chaptername', 'pwa_country.name as countryname', 'pwa_state.name as statename')
        // ->join('pwa_category','customers.category','=', 'pwa_category.id')
        // ->join('pwa_subcategory','customers.subcategory','=', 'pwa_subcategory.id')
        // ->join('pwa_chapter','customers.chapter','=', 'pwa_chapter.id')
        // ->join('pwa_country','customers.country','=', 'pwa_country.id')
        // ->join('pwa_state','customers.state','=', 'pwa_state.id')
        ->where('customers.id', $id)->where('customers.status', 1)->first();
        
        return view('includes.memberdetails', compact('memberdetails')); 
        
        }
        else{
             return view('includes.login'); 
        }
    }
    
    public function opportunitylist()
    {
        if(Auth::guard('customer')->check())
        {
            $id = Auth::guard('customer')->id();
            $chap = Auth::guard('customer')->user()->category;
            
           $data['given'] = DB::table('opportunity')->select('opportunity.*')
        ->where('opportunity.cust_id',$id)
        // ->where('opportunity.category', $chap)
        ->where('opportunity.status', 1)
        ->orderBy('id', 'desc')
        ->get();
        
        
        
        
        $data['received'] = DB::table('opportunity')->select('opportunity.*')
        ->where('opportunity.cust_id','!=',$id)
        ->where('opportunity.category', $chap)
        ->orWhere('opportunity.member', '=', $id)
        ->where('opportunity.status', 1)
        ->orderBy('id', 'desc')
        ->get();
        
      
            
            
            
            return view('includes.listopportunity', compact('data')); 
        }
        else{
            return redirect()->route('login');
        }
    }
    public function opportunitystore(Request $request)
    {
        $data['uid'] = "REQ".uniqid();
        $data['cust_id'] = Auth::guard('customer')->id();
        $data['opportunitytype'] = $request->input('opportunitytype');
        $data['opportunityto'] = $request->input('opportunityto');
        $data['referalstatus'] = $request->input('referalstatus');
        $data['referencetype'] = $request->input('referencetype');
        $data['descp'] = $request->input('descp');
        $data['phone'] = $request->input('phone');
        $data['name'] = $request->input('name');
        $data['member'] = $request->input('member');
        $data['category'] = $request->input('category');
        $data['subcategory'] = $request->input('subcategory');
        $data['created_at'] = date('Y-m-d H:i:s');
        // dd($data);
        if(Auth::guard('customer')->user()->roles == 1){
           
        // $data['chapter'] = Auth::guard('customer')->user()->category;
        $data['status'] = 2;
        }
        else if(Auth::guard('customer')->user()->roles == 2)
        {
            
            if($request->input('opportunitytype') == 4)
            {
                $data['category'] = NULL;
                $data['member'] = NULL;
                $data['status'] = 2;
                
            }
            // else
            // {
            //     $data['chapter'] = $request->input('chapter');
            // }
            
        }
       
        // dd($data);
        $result =  DB::table('opportunity')->insert($data);

        if(!empty($result))
        {
            if($data['member']){
                
                $custnumb =  DB::table('customers')->where('id', $data['member'])->first();
                
                echo $custnumb->phone;
                $client = new Guzle();
                $workingKey = 'Ab03e3e01101171ea663244197610958f';
                $sender = 'VBFSMS';
                $to = $custnumb->phone;
                $message = 'Requirement received for your Product / Service through Vipra Business Forum. Please log in to the V-Biz app and Check from your message box.';
                $templateid = '1207168343802545896';
                
                $url = 'http://map-alerts.smsalerts.biz/api/web2sms.php';
                $params = [
                'query' => [
                'workingkey' => $workingKey,
                'sender' => $sender,
                'to' => $to,
                'message' => $message,
                'template id' => $templateid
                ]
                ];
                $response = $client->get($url, $params);
                // dd($response);
                $status_code = $response->getStatusCode();
                // dd($status_code);
                
            }
            
            $otp = mt_rand(100000, 999999);
                $client = new Guzle();
                $workingKey = 'Ab03e3e01101171ea663244197610958f';
                $sender = 'VBFSMS';
                $to = Auth::guard('customer')->user()->phone;
                $message = 'Your requirement has been posted. Our members from particular category will contact you shortly. For any details call back Vipra Business Forum on 9606274007';
                $templateid = '1207168343809077877';
                
                $url = 'http://map-alerts.smsalerts.biz/api/web2sms.php';
                $params = [
                'query' => [
                'workingkey' => $workingKey,
                'sender' => $sender,
                'to' => $to,
                'message' => $message,
                'template id' => $templateid
                ]
                ];
                $response = $client->get($url, $params);
                
                $status_code = $response->getStatusCode();
                if($status_code == '200')
                {
                    return redirect()->route('login.opportunity.list')->with('success', 'Your requirement is noted, Our registered member will reach you soon');
                }
                else{
                    return redirect()->route('login.opportunity.add')->with('error', 'Sms gateway invalid now!!!');
                }
        }
        else
        {
            return redirect()->route('login.opportunity.add')->with('error', 'Something wrong & invalid');
        }
    
    }
    public function opportunityadd()
    {
        if(Auth::guard('customer')->check())
        {
        return view('includes.addopportunity'); 
        }
        else{
            return redirect()->route('login');
        }
    }
    public function opportunitydetails($id)
    {
       
        $list = DB::table('opportunity')
        ->select('opportunity.name as opname','opportunity.descp as descpname','opportunity.phone','customers.username as custname', 'opportunity.created_at as dat', 'pwa_referencetype.name as refname', 'pwa_opportunitytype.name as optname', 'pwa_referalstatus.name as referalname', 'pwa_opportunityconnect.name as conname')
        ->join('customers','opportunity.cust_id','=', 'customers.id', 'left')
        ->join('pwa_referencetype','opportunity.referencetype','=', 'pwa_referencetype.id', 'left')
        ->join('pwa_opportunitytype','opportunity.opportunitytype','=', 'pwa_opportunitytype.id', 'left')
        ->join('pwa_referalstatus','opportunity.referalstatus','=', 'pwa_referalstatus.id', 'left')
        ->join('pwa_opportunityconnect','opportunity.opportunityto','=', 'pwa_opportunityconnect.id', 'left')
        ->where('opportunity.id', $id)->first();
        
        return view('includes.opportunitydetails', compact('list'));  
    }
     public function allmedia()
    {
        if(Auth::guard('customer')->check())
        {
            
            //checking expiry of business post
                $dae = \Carbon\Carbon::today()->subDay(7);  /*after one week expiry*/
                $items = DB::table('media')->select('*')->where('created_at', '<=', $dae)->where('status', 1)->get();
                // dd($items);
                if($items){
                    foreach($items as $item)
                    {
                        $daa['status'] = 4;
                        $res =  DB::table('media')->where('id', $item->id)->update($daa);
                    }
                }
                
                
                
         $data =  DB::table('media')->orderBy('id', 'desc')->where('status',1)->get();
            return view('includes.listmedia', compact('data')); 
        }
        else{
            return redirect()->route('login');
        }
    }
    public function allmediaposts($id)
    {
        if(Auth::guard('customer')->check())
        {
            $media =  DB::table('media')->where('id', $id)->first();
            return view('includes.listmediaposts', compact('media')); 
        }
        else
        {
            return redirect()->route('login');
        }
    }
    public function addmedia()
    {
        if(Auth::guard('customer')->check())
        {
            
        return view('includes.addmedia'); 
        }
        else{
            return redirect()->route('login');
        }
    }
     public function addmediastore(Request $request)
    {
        if(Auth::guard('customer')->check())
        {
          
            //validation for daily once
            $chkmedia =  DB::table('media')
            ->where('cust_id','=' , Auth::guard('customer')->id())
            // ->where('created_at','LIke', date('Y-m-d').'%')
            // ->where('created_at','LIKE', \Carbon\Carbon::today()->format('Y-m-d').'%')
            
            ->whereBetween('created_at', [
        \Carbon\Carbon::now()->subDays(7)->startOfDay(),
        \Carbon\Carbon::now()->endOfDay()
    ])
            ->first();
            if(!empty($chkmedia))
            {
                return redirect()->route('login.media.add')->with('error', 'Business Posting is limited! You can add only one per week');
            }
            else{
                
                
                //validation for weekly twice 
            //     $weekmedia =  DB::table('media')
            // ->where('cust_id','=' , Auth::guard('customer')->id())
            // ->whereBetween('created_at', [\Carbon\Carbon::today()->startOfWeek(), \Carbon\Carbon::today()->endOfWeek()])
            // ->count();
            
            // if($weekmedia >= 2)
            // {
            //     return redirect()->route('login.media.add')->with('error', 'Business Posting is limited! You can add only weekly twice');
            // }
            
            
            $data['cust_id'] = Auth::guard('customer')->id();
            $data['title'] = $request->input('title');
            $data['category'] = $request->input('category');
            $data['uid'] = "BP".uniqid();
            $data['descp'] = $request->input('descp');
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['status'] = 2;
            
            if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= date('YmdHis').$file->getClientOriginalName();
            $file-> move(public_path('uploads/media'), $filename);
            $data['image']= $filename;
        }
            
           
            
            $result =  DB::table('media')->insert($data);
    
            if(!empty($result))
            {
                return redirect()->route('login.media.list')->with('success', 'New Business Posted');
            }
            else
            {
                return redirect()->route('login.media.add')->with('error', 'Something wrong & invalid');
            }
        }
        }
        else{
            return redirect()->route('login');
        }
    
    }


}
