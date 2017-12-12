@extends('admin.layout._base')

@section('body')

@section('content')
@show
@stop

@section('footer')
    <!-- jQuery 2.1.3 -->
    <script src="/vendor/jquery/jquery.min.js" type="text/javascript"></script>
    <!-- Bootstrap 3.3.7 JS -->
    <script src="/vendor/bootstrap/js/bootstrap.js" type="text/javascript"></script>
    <script src="/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/back/js/common.js"></script>

    @section('extra_plugin')
    @show{{-- 额外的 js 插件 --}}

    @section('footer_js')
    @show{{-- 自定义 js 文件 --}}
@stop
