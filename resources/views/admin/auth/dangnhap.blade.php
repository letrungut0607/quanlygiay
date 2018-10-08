<!DOCTYPE html>
<html lang="en">
<head>
  <title>Đăng nhập hệ thống quản trị</title><meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="{{ asset('css/admin/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/admin/bootstrap-responsive.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/admin/matrix-login.css') }}" />
   <link href="{{ asset('css/admin/font-awesome.css') }}" rel="stylesheet" />
</head>
    <body>
        <div id="loginbox">  
            @include('partials.admin-form-error')
            @if (session('status'))
                <div class="my-alert">
                   <div class="alert alert-success">
                     <button class="close" data-dismiss="alert">×</button>
                        {{ session('status') }}
                   </div>
                </div>
            @endif
            @include('partials.alert-info')          
            <form class="form-vertical" action="{{ route('admin.login.page') }}" method="post" id="loginform" autocomplete="off">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="control-group normal_text"> <h3><img src="{{ asset('img/logo-admin.png') }}" alt="Quản lý" /></h3>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" placeholder="Tài khoản" name="taikhoan" required autofocus value="{{ old('taikhoan', 'admin') }}" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" placeholder="Mật khẩu" name="password" required value="demo" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    {{-- <span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Quên mật khẩu?</a></span> --}}
                    <span class="pull-right"><button type="submit" class="btn btn-success"> Đăng nhập</button>
                    </span>
                </div>
            </form>
            {{-- <form id="recoverform" action="{{ url('admin/password/email') }}" class="form-vertical" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <p class="normal_text">Hãy nhập email của bạn chúng tôi sẽ gửi link khôi phục mật khẩu đến cho bạn.</p>
                
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input type="text" placeholder="Email" name="email" />
                        </div>
                    </div>
               
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Quay lại</a></span>
                    <button type="submit" class="btn btn-info pull-right">Gửi link</button>
                </div>
            </form> --}}
        </div>
        <script src="{{ asset('js/admin/jquery.min.js') }}"></script> 
        <script src="{{ asset('js/admin/bootstrap.min.js') }}"></script> 
        <script src="{{ asset('js/admin/matrix.login.js') }}"></script> 
        <script type="text/javascript">
            $(document).ready(function() {
                window.setTimeout(function() {
                    $(".my-alert").fadeTo(1500, 0.4).slideUp(1500, function() {
                        $(this).remove()
                    })
                }, 3000);
            });
        </script>
    </body>

</html>
