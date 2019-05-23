<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Hash;

use Session;
use App\Model\Admin\User;
class LoginController extends Controller
{
    public function login()
    {
        // dump(session('code'));

        
    	return view('Admin.login.login');
    }

    public function dologin(Request $request)
    {

    	 $uname = $request->username;

    	 $rs = User::where('username',$uname)->first();
         
         // dump($rs);
    	 if(!$rs)
    	 {
    	 	return back()->with('error','账号或者密码错误');
    	 }
         
         $pass = $rs->password;
    	 if(!Hash::check($request->password,$pass))
    	 {
    	 	return back()->with('error','用户名或密码错误');
    	 }

         if($request->code!=session('code'))
         {
         	return back()->with('error','验证码错误');
         }

         session(['id'=>$rs->id,'pid'=>'1']);

         return redirect('/admin');

         

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
	    $builder->build($width = 120, $height = 45, $font = null);
	    // 获取验证码的内容
	    $phrase = $builder->getPhrase();
	    //把内容存入session
	    session::flash('code', $phrase);
	    //生成图片
	    header("Cache-Control: no-cache, must-revalidate");
	    header("Content-Type:image/jpeg");
	    $builder->output();

    }
    
    public function pass(Request $request)
    {

        return view('Admin/login/pass');

    }

     public function dopass(Request $request)
    {
        
        $rs = User::where('id',session('id'))->first();

        if(!Hash::check($request->password,$rs->password))
        {
            return back()->with('error','旧密码不正确');
        }

        if($request->newpass!=$request->tppass)
        {
            return back()->with('error','两次密码不一致');
        }

        $re['password']=Hash::make($request->newpass);
         
        
        $result = User::where('id',session('id'))->update($re);

        // dump($result);


        if($result)
        {
           
           
           // echo "<script>var index=parent.layer.getFrameIndex(window.name);
           //          parent.layer.close(index);</script>";
           //  sleep(1);
           echo "<script>parent.location.reload();</script>";

        }else{

            return back();
        }



        // dump($rs);die;
        // echo '222';

    }

    public function out()
    {   
        dump(session('code'));
        session(['id'=>'']);
        
        return redirect('/admin/login');
    }
    
    


}

