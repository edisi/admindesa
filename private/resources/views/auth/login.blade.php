@extends('layouts.login')

@section('main')
    <div class="main-login col-sm-4 col-sm-offset-4">
        <div class="logo"><img src="{{asset('assets/images/logo.png')}}">
        </div>

        <div class="box-login">
            <h3>Login</h3>  
            <p>Silahkan isi Email & Password anda.</p>
            <form class="form-login" action="{{ url('/login') }}" method="post">
                {{ csrf_field() }}

                @include('errors/pesan_muncul') 
                
                <fieldset>
                    <div class="form-group">
                        <span class="input-icon">
                            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                            <i class="fa fa-user"></i> 
                        </span>
                    </div>
                    <div class="form-group">
                        <span class="input-icon">
                            <input type="password" class="form-control password" name="password" placeholder="Password">
                            <i class="fa fa-lock"></i>
                            <a class="forgot" href="{{ url('/password/reset') }}">
                                Lupa Password?
                            </a>
                        </span>
                    </div>
                    <div class="form-actions"> 
                        @if (JmlAdmin() < 1)
                            <a class="btn btn-orange" href="{{url('/registrasi')}}">
                                <i class="fa fa-group"></i> Registrasi
                            </a> 
                        @endif 
                                               
                        <button name="submit" type="submit" class="btn btn-bricky pull-right">
                            Login <i class="fa fa-sign-in"></i>
                        </button>
                    </div>                      
                </fieldset>
            </form>
        </div>
        
        <div class="copyright">
            &copy; Aplikasi Administrasi Pemerintah Desa
        </div>

    </div>
@endsection

