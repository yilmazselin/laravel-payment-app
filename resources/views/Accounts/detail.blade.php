@include('inc.header')
@include('inc.menu')
<div class="content-page">
    <div class="container">
    @include('inc.head')
      <div class="row align-items-center my-4">
            <div class="col-12">
                <h5 class="page-title text-secondary mb-0">Hesap Detayı</h5>
            </div>
        </div>
        @if (\Session::has('success'))
        <div class="row">
            <div class="col-lg-12">
              <div class="alert alert-success" role="alert">
                {{ \Session::get('success') }}
              </div>
            </div>
        </div>
    @endif
        @if (count($errors) > 0)
          @foreach ($errors->all() as $error)
          <div class="alert alert-danger" role="alert">
              {{$error}}
            </div>
          @endforeach
          @endif
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{url('/account/update')}}/{{$account->id}}" method="post">
                            @csrf
                            <div class="row">
                              <div class="form-group col-md-6 mb-4">
                                <label class="mb-1" for="name">Hesap Adı</label>
                                <input type="text" class="form-control " id="name" name="name" value="{{$account->name}}" placeholder="Hesap Adı">
                              </div>
                              <div class="form-group col-md-6 mb-4">
                                <label class="mb-1" for="dealerId">Bayi Id</label>
                                <input type="text" class="form-control " id="dealerId" name="dealerId" value="{{$account->dealerId}}"  placeholder="Bayi Id">
                              </div>
                              <div class="form-group col-md-6 mb-4">
                                <label class="mb-1" for="apiKey">Api Key</label>
                                <input type="text" class="form-control " name="apiKey" id="apiKey"  value="{{$account->apiKey}}" placeholder="Api Key">
                              </div>
                              <div class="form-group col-md-6 mb-4">
                                <label class="mb-1" for="secretKey">Secret Key</label>
                                <input type="text" class="form-control " id="secretKey" name="secretKey"  value="{{$account->secretKey}}" placeholder="Secret Key">
                              </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Güncelle</button>
                          </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@include('inc.footer')