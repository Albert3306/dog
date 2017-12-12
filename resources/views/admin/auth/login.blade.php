@extends('admin.layout._base')

@section('body')
    <div class="container-fluid content">
        <div class="row">
            <div id="content" class="col-sm-12 full">
                <div class="row">
                    <div class="login-box">
                        <div class="header">后台登录</div>
                        @if (count($errors) > 0)
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-ban"></i> 警告!</h4>
                            <p>{!! $errors->first('attempt') !!}</p>
                        </div>
                        @endif
                        <form class="form-horizontal login" action="/admin/auth/login" method="post">
                            <fieldset class="col-sm-12">
                                <div class="form-group">
                                    <div class="controls row">
                                        <div class="input-group col-sm-12">
                                            <input type="text" class="form-control" name="username" value="{{ $username }}" placeholder="Username or E-mail" autocomplete="new-username"/>
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="controls row">
                                        <div class="input-group col-sm-12">
                                            <input type="password" class="form-control" name="password" value="{{ $password }}" placeholder="Password" autocomplete="new-password"/>
                                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="confirm">
                                    @if ($username)
                                    <input type="checkbox" name="check" checked="checked"/>
                                    @else
                                    <input type="checkbox" name="check"/>
                                    @endif
                                    <label for="check">记住我？</label>
                                </div>  

                                <div class="row">
                                    <button type="submit" class="btn btn-lg btn-primary col-xs-12">登录</button>
                                </div>
                                {{ csrf_field() }}
                            </fieldset>
                        </form>
                        <div class="clearfix"></div>
                    </div>
                </div><!--/row-->
            </div>
        </div><!--/row-->
    </div><!--/container-->
@stop

@section('footer')
    <!-- start: JavaScript-->
    <script src="/vendor/jquery/jquery-2.1.1.min.js"></script>
    <script src="/vendor/bootstrap/bootstrap.min.js"></script>
    <!-- end: JavaScript-->
@stop
