@include('inc.header')
<body style="background: rgb(228, 229, 247)" class="d-flex align-items-center justify-content-center vh-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mx-auto">
                <div class="card">
                    <div class="card-header text-center bg-white">
                        <img src="{{config('app.asset_url')}}images/elestas-logo.png" class="login_logo" alt="">
                    </div>
                    <div class="card-body p-5 pt-4">
                        <h5 class="text-center font-weight-bold mb-2">Giriş Yap</h5>
                            <hr>
                            @if (count($errors) > 0)
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                {{$error}}
                              </div>
                            @endforeach
                            @endif
                            
                            <form action="{{url('/login/run')}}" method="POST">
                                @csrf
                            <div class="form-group mb-3">
                              <label class="mb-1" for="email">E-posta adresi</label>
                              <input required type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group mb-3">
                              <label class="mb-1" for="password">Password</label>
                              <input required type="password" class="form-control" name="password" id="password">
                            </div>
                            <button style="height:40px" type="submit" class="btn btn-primary btn-md w-100">Giriş Yap</button>
                          </form>

                    </div>
                </div>
            </div>
        </div>
        
    </div>
@include('inc.footer')