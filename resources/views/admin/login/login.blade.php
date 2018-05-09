@extends('admin.layout._base')

@section('body')
<div class="login-page">
    <div class="login-main">    
         <div class="login-head">
                <h1>Login</h1>
            </div>
            <div class="login-block">
                @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> 警告!</h4>
                    @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <form method="post" action="{{ url('/admin/login') }}">
                    {{ csrf_field() }}
                    <input type="text" name="username" placeholder="账号" autocomplete="new-username">
                    <input type="password" class="lock" name="password" placeholder="密码" autocomplete="new-password">
                    <input type="submit" name="Sign In" value="登  陆">
                </form>
            </div>
      </div>
</div>
@stop

@section('footer')
    <script type="text/javascript" src="{{ asset('/vendor/jquery/jquery-2.1.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/bootstrap/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/back/js/jquery.nicescroll.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/back/js/scripts.js') }}"></script>
@stop