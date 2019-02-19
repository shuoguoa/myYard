<?php
 namespace App\Http\Controllers\Auth;
 use App\Models\Users;
 use Validator;
 use App\Http\Controllers\Controller;
 use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

 class WebAuthController extends Controller{
//     use AuthenticatesAndRegistersUsers;

     //创建一个新的授权控制器实例
     public function __construct()
     {
         echo 2222;exit;
         //$this->middleware('gust', ['except' => ['getLogout', 'getRegister']]);
     }

     //对输入的登录数据进行验证
     public function validator(array $data){
         return Validator::make($data, [
             'username' => 'required | max:255',
             'account'  => 'require | max:255 | unique:users',
             'password' => 'required | confirmed | min:6',
         ]);
     }

     //想用户数据表添加一条数据

     protected  function create(array $data){
         return Users::create([
            'username' => $data['username'],
             'account' => $data['account'],
             'password'=> $data['password'],
             'addtime' => time(),
         ]);
     }

     public function login(){ echo 7777;exit;
//         $param = $_POST;

//         var_dump($param);exit;


//         return view('login');
     }
 }
