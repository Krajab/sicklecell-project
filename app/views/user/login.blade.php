<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap-theme.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/layout.css') }}" />
        <title>{{ Config::get('kblis.name') }} {{ Config::get('kblis.version') }}</title>
    </head>
    <body>
        <div class="container login-page">
            <!-- <div class="header">
                @include('user.loginHeader')
            </div> -->
            <div class="login-form">
                <div class="form-head">
                    <!-- <h3> Login </h3> -->
                      <p class="login-img"><p style="text-align:center"><img src="i/coat_of_arms_of_uganda.png" alt="" width="90" height="90"> </p> 
                     <h4 align="center"><font color="black"><b> Sickle Cell Disease (LIMS)</b></font></h4>
                    @if($errors->all())
                        <div class="alert alert-danger">
                            {{ HTML::ul($errors->all()) }}
                        </div>
                    @elseif (Session::has('message'))
                        <div class="alert alert-danger">{{ Session::get('message') }}</div>
                    @endif
                </div>

                {{ Form::open(array(
                    "route"        => "user.login",
                    "autocomplete" => "off",
                    "class" => "form-horizontal",
                    "role" => "form"
                )) }}            
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon glyphicon glyphicon-user"></span>
                            {{ Form::text("username", Input::old("username"), array(
                                "placeholder" => trans('messages.username'),
                                "class" => "form-control"
                            )) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon glyphicon glyphicon-lock"></span>
                            {{ Form::password("password", array(
                                "placeholder" => Lang::choice('messages.password',1),
                                "class" => "form-control"
                            )) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            {{ Form::button(trans('messages.login'), array(
                                "type" => "submit",
                                "class" => "btn btn-primary btn-block"
                            )) }}
                        </div>
                    </div>
                {{ Form::close() }}
                <div class="smaller-text alone foot">
                    <p><a href="i/guide.pdf">User Guide</a></p>
                    <p>
                        {{ Config::get('kblis.name') }} -  ASLM Laboratory Information System (ALIS). Step towards fighting Sickle cell in Uganda
                    </p>
                </div>
            </div>
            <!-- <div class="footer">
            @include('user.loginFooter')
            </div> -->

        </div>
    </body>
</html>