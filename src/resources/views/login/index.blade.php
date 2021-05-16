@extends('console-service::layouts.non-auth')

@section('content')
    <div class="account-pages my-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-md-6 p-5">
                                    <div class="mx-auto mb-5">
                                        <a href="{{ route('login.index') }}">
                                            <img src="{{ URL::asset('console-service/assets/images/logo.png') }}" alt="" height="24" />
                                            <h3 class="d-inline align-middle ml-1 text-logo">Seventh</h3>
                                        </a>
                                    </div>

                                    <h6 class="h5 mb-0 mt-4">Seja bem-vindo!</h6>
                                    <p class="text-muted mt-1 mb-4">Digite seu endereço de e-mail e senha para acessar o painel de administração.</p>

                                    <form action="{{ route('login.authenticate') }}" method="POST" class="authentication-form">
                                        @csrf
                                        <div class="form-group">
                                            <label class="form-control-label">E-mail</label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="icon-dual" data-feather="mail"></i>
                                                    </span>
                                                </div>
                                                <input type="email" class="form-control" name="email" id="email" placeholder="hello@seventh.com">
                                            </div>
                                        </div>

                                        <div class="form-group mt-4">
                                            <label class="form-control-label">Senha</label>
                                            <a href="pages-recoverpw.html" class="float-right text-muted text-unline-dashed ml-1">Esqueceu sua senha?</a>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="icon-dual" data-feather="lock"></i>
                                                    </span>
                                                </div>
                                                <input type="password" class="form-control" name="password" id="password" placeholder="Coloque sua senha">
                                            </div>
                                        </div>

                                        {{-- <div class="form-group mb-4">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="remember" value="1" id="checkbox-signin" checked>
                                                <label class="custom-control-label" for="checkbox-signin">Lembre-me</label>
                                            </div>
                                        </div> --}}

                                        <div class="form-group mb-0 text-center mt-5">
                                            <button class="btn btn-primary btn-block" type="submit"> Log In</button>
                                        </div>
                                    </form>                                                                    
                                </div>
                                <div class="col-lg-6 d-none d-md-inline-block">
                                    <div class="auth-page-sidebar"></div>
                                </div>
                            </div>                         
                        </div>
                    </div>
                </div> 
            </div>            
        </div>        
    </div>
@endsection