<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Events\UserLogin;
use App\Events\UserLogout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;

/**
 * 登陆管理控制器
 */
class LoginController extends Controller
{
    use ThrottlesLogins;

    /**
     * 添加路由过滤中间件
     */
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'getLogout']);
    }

    /**
     * 登录页
     */
    public function getLogin()
    {
        return view('admin.login.login');
    }

    /**
     * 登录提交页
     */
    public function postLogin(Request $request)
    {
        // 登陆次数限制
        if ($this->hasTooManyLoginAttempts($request)) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['msg' => '您密码错误次数太多了，请 60 秒后再试！']);
        }

        // 获取认证凭证
        $where = $request->only('username', 'password');
        $where['status'] = 1;

        // 验证登陆
        if (Auth::guard('admin')->attempt($where)) {
            // 清除登陆失败次数
            $this->clearLoginAttempts($request);

            @event(new UserLogin(auth('admin')->user()));  // 触发登录事件
            return redirect()->intended('/admin');
        } else {
            // 记录登陆失败次数
            $this->incrementLoginAttempts($request);

            // 登录失败，跳回
            return redirect()->back()
                             ->withInput()
                             ->withErrors(['msg' => '“用户名”、“密码”错误或帐号已被禁用，请重新登录或联系系统管理员！']);
        }
    }

    /**
     * 退出登录
     */
    public function getLogout()
    {
        @event(new UserLogout(auth('admin')->user()));  //触发登出事件
        Auth::guard('admin')->logout();
        return redirect()->to(url('admin/login'));
    }

    public function username()
    {
        return 'username';
    }
}
