<!DOCTYPE html>
<html lang="en">
<head>
  <title>Khôi phục mật khẩu của bạn</title><meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="{{ asset('css/admin/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/admin/bootstrap-responsive.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/admin/matrix-login.css') }}" />
   <link href="{{ asset('css/admin/font-awesome.css') }}" rel="stylesheet" />
</head>
    <body>
        <div id="loginbox">  
            @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                <div class="my-alert">
                   <div class="alert alert-success">
                     <button class="close" data-dismiss="alert">×</button>
                        {{ $error }}
                   </div>
                </div>
                @endforeach
            @endif
            @include('partials.alert-info')          
            <form class="form-vertical" method="POST" action="{{ url('/admin/password/reset') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="control-group normal_text"> <h3><img src="{{ asset('img/logo-admin.png') }}" alt="Quản lý" /></h3>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="email" placeholder="Email" name="email" required value="{{ $email or old('email') }}"/>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" placeholder="Mật khẩu mới" name="password_confirmation" required />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" placeholder="Lập lại mật khẩu" name="password" required />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-left"><a href="{{ route('dashboard') }}" class="flip-link btn btn-success">Quay lại</a></span>
                    <button type="submit" class="btn btn-info pull-right">Đổi mật khẩu</button>
                </div>
            </form>
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
