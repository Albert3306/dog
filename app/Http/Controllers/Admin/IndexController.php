<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * 后台入口控制器
 */
class IndexController extends Controller
{
    /**
     * 入口
     */
    public function index()
    {
        return view('admin.index.index');
    }
}
