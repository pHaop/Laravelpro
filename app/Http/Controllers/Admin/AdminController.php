<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FormRequest;

use Hash;

use App\Model\Admin\User;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        // session(['id'=>'']);
        
        $img = User::where('id',session('id'))->first();

        $data = User::count();

        $uname = $request->uname;
       
    	$rs = User::where('username','like','%'.$uname.'%')->paginate(5);

        return view('Admin.admin.list',['rs'=>$rs,'img'=>$img,'data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.admin.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rs = $request->except('_token','img');

        //处理图片上传
        if($request->hasFile('img')){

            //获取图片上传的信息
            $file = $request->file('img');

            //名字
            $name = 'img_'.rand(1111,9999).time();

            //获取后缀
            $suffix = $file->getClientOriginalExtension();

            $file->move('./uploads',$name.'.'.$suffix);

            $rs['img'] = '/uploads/'.$name.'.'.$suffix;

        }
        $rs['create_time'] = time();
        
        $rs['password'] = Hash::make($request->password);

        $arr = User::create($rs);

        return redirect('admin/user');

        // dump($rs);

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
       return view('Admin/admin/edit',['rs'=>$rs]);
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
    	$rs = $request->except('_token','_method');

    	if($request->hasFile('img')){

            //获取图片上传的信息
            $file = $request->file('img');

            //名字
            $name = 'img_'.rand(1111,9999).time();

            //获取后缀
            $suffix = $file->getClientOriginalExtension();

            $file->move('./uploads',$name.'.'.$suffix);

            $rs['img'] = '/uploads/'.$name.'.'.$suffix;

        }
        // dump($rs);
    	// dump($request->input());
        $arr = User::where('id',$id)->update($rs);
        if($arr)
        {
          echo "<script>parent.location.reload();</script>";
        }else{
          return back()->with('error','删除失败');
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
    	$rs = User::destroy($id);
    	if($rs){

            return redirect('/admin/user')->with('success','删除成功');
        } else {

            return back()->with('error','删除失败');

        }
    }
    public function status($id)
    {
       echo $id;

    }


}
