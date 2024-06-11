<?php

namespace App\Http\Controllers;
use App\Traits\ApiConsumse;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * @var array
     */
    public static $aclRolesPermissions =
    [
        [
           "role" => "user", // Rumah Sakit //

           "permissions" => [

              "emrs.create", // Create Data EMR MCU (Pengisian EMR MCU) //
              "emrs.update", // Update Data EMR MCU (Pengisian EMR MCU) //
              "emrs.view", // View Data EMR MCU (Pengisian EMR MCU) //
              "reports.report", // Report Data Report MCU //
              "sds.report", // Report Data SDS MCU //
              "results.export", // Export Data Pasien MCU //
           ],
        ],

        [
          "role" => "mitra", // Rekanan //

          "permissions" => [

            "patients.viewAny", // List Data Pasien MCU //
            "results.view", // View Data MCU //
         ],
       ],
    ];

    /**
     * @param string $role
     * @return string
     */
    public static function encode($role)
    {
      return json_encode(collect(self::$aclRolesPermissions)->filter(function ($item) use ($role) { return $item["role"] == $role; })->firstOrFail()["permissions"]);
    }

    /**
     * @param string $permission
     * @return bool
     */
    public static function decode($permission)
    {
      $encode = \Cookie::get("permissions");
      return $encode ? in_array($permission, json_decode($encode)) : false;
    }

    /**
     * @param string $permission
     * @return bool
     */
    public static function can($permission)
    {
      return self::decode($permission);
    }

    use ApiConsumse;
    public function index(){
      $user = request()->cookie('login');
    
      if($user <> null){
            return Redirect('/main');
      }else{
           return view('login.login', [ "acl" => collect(self::$aclRolesPermissions)->pluck("role"), ]);
      }
    }

    public function proses_login(Request $request){

        Validator::make($request->all(), [
          'acl' => ['required', 'in:'.implode(",", collect(self::$aclRolesPermissions)->pluck("role")->toArray())],
          'username' => ['required', 'string', 'max:255'],
          'password' => Password::min(3),
          'captcha' => 'required|captcha',
        ],
        [
          'captcha' => "Captcha is not correct.",
        ])->validate();

        $JsonData =  $this->GuzzleClientRequestPost(
          env('API_URL_YARSI') . "getLoginSimrs",
          "POST",
          json_encode([
              'username' => $request->username,
              'password' => $request->password,
          ])
        );
        if($JsonData['status'] == true && count($JsonData['data'])){
            $role = $request->acl;
            $permissions = self::encode($role);

            return Redirect('/')
            ->withCookie(cookie('login', 'True',60))
            ->withCookie(cookie('nama', @$JsonData['data']['0']['First Name'],60))
            ->withCookie(cookie('role', $role))
            ->withCookie(cookie('permissions', $permissions));
        }else{
            return redirect('login')
            ->withInput()
            ->withErrors(['login_gagal' => 'These credentials do not match our records.']);
        }
    }
    public function logout(){

      return redirect('login')
      ->withCookie(\Cookie::forget("login"))
      ->withCookie(\Cookie::forget("nama"))
      ->withCookie(\Cookie::forget("role"))
      ->withCookie(\Cookie::forget("permissions"));
    }
}
