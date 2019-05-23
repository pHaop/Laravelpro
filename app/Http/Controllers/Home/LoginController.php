<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;

use App\Model\Home\User;
use Session;

use Hash;

class LoginController extends Controller
{
    
 public function index()
 {

 	return view('Home.Login.login');
 }




 public function dologin(Request $request)
 {
 		$this->validate($request, [
            'username' => 'required|regex:/^\w{5,12}$/',
            'password' => 'required|regex:/^\S{8,16}$/',
        ],[
            'username.required' => '用户名不能为空',
            'username.regex' => '用户名格式不正确',
            'password.required'=>'密码不能为空',
            'password.regex'=>'密码格式不正确',
        ]);

      $rs = User::where('username',$request->username)->first();

      if(!$rs)
      {
 			return back()->with('error','用户名或密码错误');
      }

      if(!Hash::check($request->password,$rs->password))
      {
      		return back()->with('error','用户名或密码错误');
      }


      if($request->code!=session('code'))
      {
      		return back()->with('error','验证码错误');
      }
  
   	  return redirect('/');

 }

 public function code()
    {

    	$phrase = new PhraseBuilder;
	    //设置验证码位数
	    $code = $phrase->build(4);
	    //生成验证码图片的Builder对象，配置相应属性
	    $builder = new CaptchaBuilder($code, $phrase);
	    //设置背景颜色
	    $builder->setBackgroundColor(123, 203, 230);
	    $builder->setMaxAngle(25);
	    $builder->setMaxBehindLines(0);
	    $builder->setMaxFrontLines(0);
	    //可以设置图片宽高及字体
	    $builder->build($width = 110, $height = 40, $font = null);
	    // 获取验证码的内容
	    $phrase = $builder->getPhrase();
	    //把内容存入session
	    session::flash('code', $phrase);
	    //生成图片
	    header("Cache-Control: no-cache, must-revalidate");
	    header("Content-Type:image/jpeg");
	    $builder->output();

    }




 public function zhuce()
 {

 	return view('Home.Login.zhuce');
 }


public function dozhuce(Request $request)
{
  
 		$this->validate($request, [
            'username' => 'required|regex:/^\w{6,12}$/',
            'password' => 'required|regex:/^\S{8,16}$/',
            'email'=> 'email',
            'username' => 'unique:user,username',
            'phone'=>'required|regex:/^1[3456789]\d{9}$/'
            
        ],[
            'username.required' => '用户名不能为空',
            'username.regex' => '用户名格式不正确',
            'password.required'=>'密码不能为空',
            'password.regex'=>'密码格式不正确',
            'email.email'=>'邮箱格式不正确',
            'phone.required'=>'手机号码不能为空',
            'phone.regex'=>'手机号码格式不正确',
        ]);


       if($request->yzm!=session('yzm'))
       {
       	return back()->with('error','验证码不正确');
       }


       $rs = $request->except('_token','yzm','password');
       $rs['person']= '/uploads/user.jpg';
       $rs['password']= Hash::make($request->password);
 	   $rs['status'] ='0';
       $rs['addtime'] = date('Y-m-d H:i:s');
       
       $data = User::create($rs);
       if($data)
       {
          return redirect('/home/login');
       }else{
       	  return back();
       }
   
 }
 public function yzm(Request $request)
 {

		require_once("../app/lib/Ucpaas.class.php");
        //初始化必填
        //填写在开发者控制台首页上的Account Sid
         $options['accountsid']='85c49030c82ab2108c3dac73d86cb7dd';
        //填写在开发者控制台首页上的Auth Token
         $options['token']='dc12394a27fa1e1599dc7d38a25bb20e';
        //初始化 $options必填
        $ucpass = new \Ucpaas($options);
 
        $appid = "be29d6ddacf54e7a821cdf1ef52d3f0e";	//应用的ID，可在开发者控制台内的短信产品下查看
        $templateid = "469973";    //可在后台短信产品→选择接入的应用→短信模板-模板ID，查看该模板ID
        // $yzm = base64_decode($request->input('yzm')); //多个参数使用英文逗号隔开（如：param=“a,b,c”），如为参数则留空   code进行解密
        $time = 5;
        $param=rand(1111,9999);
        $mobile= $request->phone;//$_POST['yzmtel']
        $uid = "";
        //70字内（含70字）计一条，超过70字，按67字/条计费，超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。
        echo $ucpass->SendSms($appid,$templateid,$param,$mobile,$uid);
        session(['yzm'=>$param]);

 }







}
