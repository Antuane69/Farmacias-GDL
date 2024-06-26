<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\TokyoCorreos;
use App\Models\Audit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public function inicio(){

        if(Auth::check()){
            return view('dashboard');
        }else{
            return view('auth.login');
        };
        
    }

    public function register(){
        $roles = ['User','Administrator'];
        return view('register',[
            'roles' => $roles
        ]);
    }

    protected $allowedNumbers = [1234, 4567, 7890];

    public function register_save(Request $request){
        if($request->role == 'Administrator'){
            $number = $request->input('role_val');
            if (!in_array($number, $this->allowedNumbers)) {
                return redirect()->back()->withErrors(['role_val' => 'The Code is Incorrect.'])->withInput();
            }
        }

        if($request->password == $request->password_val_confirmation){
            User::create([
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'role' => $request->role,
                'email' => $request->email,
            ]);
            return redirect()->route('dashboard');
        }else{
            return redirect()->back()->withErrors(['password' => 'The Password Validation is Incorrect.'])->withInput();
        }
 
    }
}
