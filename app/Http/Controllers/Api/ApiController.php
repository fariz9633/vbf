<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Customer;

use Carbon\Carbon;

use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;

use Response;

use Validator,Redirect;

use App;

use Session;

use Auth;

use Crypt;

// use Illuminate\Support\Facades\Session;

class ApiController extends Controller
{

public function register(Request $request)
{
    // echo "welcome";die;
    $chkemail =  DB::table('customers')->where('email', $request->input('email'))->first();
   
    $chkphone =  DB::table('customers')->where('phone', $request->input('phone'))->first();
    if(empty($chkphone) && empty($chkemail))
    {
          $data['firstname'] = $request->input('name');
                    //  $data['lastname'] = $request->input('lastname');
                    //  $data['username'] = $request->input('firstname') .' '. $request->input('lastname');
                    $data['username'] = $request->input('name');
                     $data['email'] = $request->input('email');
                     $data['password'] = Hash::make($request->password);
                     $data['phone'] = $request->input('phone');
                     $data['userType'] = 'Customer';
                     $data['status'] = '1';
                     $data['image'] = null;
                     
                      $cstresult = DB::table('customers')->insert($data);
                        $fd['custs_id'] = DB::getPdo()->lastInsertId();
    
     $result = DB::table('customer_settings')->insert($fd);
     
    // dd(Auth::guard('customer')->user()); 
    $credentials = $request->only('phone', 'password');
     if (Auth::guard('customer')->attempt($credentials)) {
        return redirect()
            ->route('dashboard')
            ->with('Welcome! Your account has been successfully created!');
    }
    
    
   
    return redirect()->route('login')->with('success','Registration successfully!!');
 
    
   }
   else{
      Session::flash('error','Exist this email or phone'); 
    //   Session::save();
        // return view('includes.register');
        // return redirect()->route('register')->with('errorstatus','Exist this email or phone');
        //  return redirect()->route('register')->with(['error' => $value]);
         return redirect()->route('register')->with('error', 'Exist this email or phone');
        //  return redirect('home')->with(['data' => $value]);
       
   }


// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => 'https://ravisubramanya.com/grievancemanagementsystem/api/register',
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'POST',
//   CURLOPT_POSTFIELDS => array('firstname' => ''. $request->input('firstname').'','lastname' => ''. $request->input('lastname').'','phone' => ''. $request->input('phone').'','email' =>''. $request->email.'','password' => ''. $request->password.''),
// ));

// $response = curl_exec($curl);

// curl_close($curl);
// $resp =  json_decode( $response);

//dd($resp);
        
}
    public function login(Request $request)
    {
        $chkphone =  DB::table('customers')->where('phone', $request->input('phone'))->where('password', Hash::check('plain-text', $request->input('password')))->first();
        //  print_r($chkphone);die;
       if($chkphone)
       {
            //  if(Hash::check($request->input('password'),$chkphone->password)){
            //           echo "password match, you can now start session";die;
            //         }
            //         else{
            //             echo"error";die;
            //         }
    
            $credentials = $request->only('phone', 'password');
            
            //  Auth::guard('customer')->attempt($credentials);
            
            
            
            if(Auth::guard('customer')->attempt($credentials))
            {
                $dat = Auth::guard('customer')->user();
                
                // Session::forget('customer');
                // Session::put('customer' , $dat);
                // echo $re = Session::get('customer');
                
                $request->session()->put('customers' , $dat);
                $request->session()->save();
                // echo $value = $request->session()->get('customers');
                
                // dd(Auth::guard('customer')->user());
                
            
                return redirect()->route('dashboard');
            }
            else
            {
                return redirect()->route('login');
            } 
       }
       else
       {
           return redirect()->route('login');
       }
       
    }
    public function dashboard()
    {
        //  echo $value = $request->session()->get('customers');die;
        // echo $fer = Session::pull('customer');die;
        // dd(Session::pull('customer'));
        // echo "weeeee";
        //  dd(Auth::user());
        //  dd(Auth::guard('customer')->check());
        
        $user = Auth::guard('customer');
        
        // echo $chk =  $user->user;die;
        // dd($user);
        // print($user);die;
        // print($user->name);
        // print($user);die;
        
        return view('includes.index'); 
    
        // if($user->user())
        // {
        //     return view('includes.index'); 
        // }
        // else
        // {
        //   return redirect()->route('login');
        // }
    }


}
