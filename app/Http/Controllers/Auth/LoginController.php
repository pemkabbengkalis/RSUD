<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Str;
use Illuminate\Support\Facades\Cache;

class LoginController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout'
        ]);
    }
    function ip_block_checker(){
        if(!empty(Cache::get('blocked_ip'))){
            $cekip = collect(Cache::get('blocked_ip'))->where('ip',request()->ip())->where('time','>=',time()-60);
            if(count($cekip)>3){
                return flooding_page();
            }
        }
    }
    function ip_blocker(){
        $arr = null;
        if(empty(Cache::get('blocked_ip'))){
            $arr = array(['ip'=>request()->ip(),'time'=>time()]);
        }else{
            $arr = Cache::get('blocked_ip');
            array_push($arr,['ip'=>request()->ip(),'time'=>time()]);
        }
        Cache::put('blocked_ip',$arr);

    }
    public function login(Request $request,User $user)
    {
        $this->ip_block_checker();
        if($request->username && $request->password){
        
        if($_POST['g-recaptcha-response']){
            $credentials = $request->validate([
                'username' => 'required|regex:/^[a-zA-Z-0-9]+$/',
                'password' => 'required',
                'g-recaptcha-response' => 'required|recaptcha',
            ]);
            unset($credentials['g-recaptcha-response']);
        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            if(Auth::user()->status == 'Aktif'){
            $user->find(Auth::user()->id)->update(['last_login_at'=>now(),'last_login_ip'=>request()->ip()]);
            if($request->session()->has('urlback')){
            return redirect(session('urlback'));
            return redirect(admin_path());  
            }   
            }
            else{
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->with('error','Akun telah diblokir!');
            } 
        }
        $this->ip_blocker();
        $request->session()->regenerateToken();
        return back()->with('error','Akun tidak ditemukan!');

        $back = url()->previous();
        $current = url()->current();
        if($back!=$current && Str::contains($back, admin_path()) ){
            session(['urlback'=>$back]);
        }}
        else{
            return back()->with('error','Captcha tidak ditemukan!');
        }
    }
        return view('auth.login');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }    

}
