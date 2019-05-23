<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Model\Admin\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
       
       $username = $request->username;

       $rs = User::where('username','like','%'.$username.'%')->paginate(7);

       // dump($rs);

       $data = User::count();
        return view('admin.user.index',
            ['rs'=>$rs,
             'title'=>'用户列表',
             'data'=>$data,
             'username'=>$username
             ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create',['title'=>'添加用户']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    

        //获取表单传过来的信息 返回的数据是一个数组
        $rs = $request->except('_token','repassword','person');

        //处理图片上传
        if($request->hasFile('person')){

            //获取图片上传的信息
            $file = $request->file('person');

            //名字
            $name = 'img_'.rand(1111,9999).time();

            //获取后缀
            $suffix = $file->getClientOriginalExtension();

            $file->move('./uploads',$name.'.'.$suffix);

            $rs['person'] = '/uploads/'.$name.'.'.$suffix;


        }

        //密码的加密
        $rs['password'] = Hash::make($request->password);

        //存放数据库里面
        $data = User::create($rs);

        if($data){

            return redirect('admin/user');

        } else {

            return back();

        }
   



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $rs = User::find($id);

        return view('admin.user.edit',[
            'title'=>'用户修改',
            'rs'=>$rs]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rs = $request->except('_token','_method','repassword');

        //处理头像
        if($request->hasFile('person')){

            //获取图片上传的信息
            $file = $request->file('person');

            //名字
            $name = 'img_'.rand(1111,9999).time();

            //获取后缀
            $suffix = $file->getClientOriginalExtension();

            $file->move('./uploads',$name.'.'.$suffix);

            $rs['person'] = '/uploads/'.$name.'.'.$suffix;

        }
        
        //密码的加密
        $rs['password'] = Hash::make($request->password);

        //修改数据
        $data = User::where('id',$id)->update($rs);

        if($data){
            
            return redirect('/admin/user');
        } else {

            return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $rks = User::find($id);
        unlink('.'.$rks['person']);
        $rs = User::destroy($id);
        if($rs){
            return redirect('/admin/user')->with('sucess','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }
}
