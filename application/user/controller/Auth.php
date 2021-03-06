<?php

namespace app\user\controller;

use think\Controller;
use think\Request;
use app\user\model\User;
use think\facade\Session;

class Auth extends Controller
{
    protected $middleware = [
        'Auth'=>[
            'except'=>[
                'create',
                'save'
            ]
        ],
    ];
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        // if(Session::has('user')){
        //     $user = Session::get('user');
        //     return redirect('user/auth/read')->params(['id'=>$user->id]);
        // }else{
        //     $token = $this->request->token('__token__', 'sha1');
        //     $this -> assign('token', $token);
        //     return $this -> fetch();
        // }
        //中间件
        return $this->fetch();
        
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        // dump($request->post());
        $requestData = $request->post();
        $result = $this->validate($requestData, 'app\user\validate\Auth');
        if(true !== $result){
            // dump($result);
            //falsh闪存
            return redirect('user\auth\create')->with('validate', $result);
        }else{
            // dump($requestData);
            // echo 'hello1';
            // return User::create($requestData);
            $user = User::create($requestData);
            Session::set('user', $user);
            return redirect('user/auth/read')->params(['id' => $user->id]);

        }
    }
    // public function save(Request $request)
    // {
    //     $requestData = $request->post();
    //     $result = $this->validate($requestData, 'app\user\validate\Auth');
    //     if (true !== $result) {
    //         dump($result);
    //     } else {
    //         dump($requestData);
    //     }
    // }
    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        // if(Session::has('user')){
        //     $user = User::find($id);
        //     $token = $this->request->token('__token__', 'sha1');
        //     $this->assign([
        //         'user'=> $user,
        //         'token'=>$token
        //     ]);
        //     return $this->fetch();
        // }else{
        //     return redirect('user/session/create')->with('validate', '请先登录');
        // }
        //中间件
        $user = User::find($id);
        $this->assign([
            'user'=> $user

        ]);
        return $this->fetch();

     
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
