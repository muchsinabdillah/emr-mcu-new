<?php

namespace App\Http\Controllers;
use App\Traits\ApiConsumse;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    //
    use ApiConsumse;
    public function index(){
      $user = request()->cookie('login');
    
      if($user <> null){
            return Redirect('/main');
      }else{
           return redirect('login');
      }
    }

    public function proses_login(Request $request){
        $JsonData =  $this->GuzzleClientRequestPost(
          env('API_URL_YARSI') . "getLoginSimrs",
          "POST",
          json_encode([
              'username' => $request->username,
              'password' => $request->password,
          ])
        );
        if($JsonData['status'] == true){
            $cookie = cookie('login', 'True',60);
            cookie('nama', $JsonData['data']['0']['First Name'],60);
            return Redirect('/')->cookie($cookie);
        }else{
            return redirect('login')
            ->withInput()
            ->withErrors(['login_gagal' => 'These credentials do not match our records.']);
        }
    }
    public function logout(){
      cookie('login',null,60);
      return redirect('login');
    }
}
