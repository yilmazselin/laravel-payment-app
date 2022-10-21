@include('inc.header')
@include('inc.menu')
<div class="content-page">
    <div class="container">
    @include('inc.head')
      <div class="row align-items-center my-4">
            <div class="col-12">
                <h5 class="page-title text-secondary mb-0">Kart Oluştur</h5>
            </div>
            
        </div>
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
                      <form action="{{url('/card/store')}}" method="post">
                            @csrf
                            <div class="row">
                              <div class="form-group col-md-6 mb-4">
                                <label class="mb-1" for="holderName">Kart Sahibi İsim Soyisim</label>
                                <input type="text" class="form-control " id="holderName" name="holderName" placeholder="İsim Soyisim">
                              </div>
                              <div class="form-group col-md-6 mb-4">
                                <label class="mb-1" for="cardNumber">Kart Numarası</label>
                                <input type="text" class="form-control " id="cardNumber" name="cardNumber" placeholder="Kart Numarası">
                              </div>
                              <div class="form-group col-md-3 mb-4">
                                <label class="mb-1" for="expiryMonth">Son Kullanma Tarihi Ay</label>
                                <input type="text" class="form-control " name="expiryMonth" id="expiryMonth" placeholder="Ay" maxlength="2">
                              </div>
                              <div class="form-group col-md-3 mb-4">
                                <label class="mb-1" for="expiryYear">Son Kullanma Tarihi Yıl</label>
                                <input type="text" class="form-control " id="expiryYear" name="expiryYear" placeholder="Yıl" maxlength="2">
                              </div>
                              <div class="form-group col-md-6 mb-4">
                                <label class="mb-1" for="cvc">CVC Numarası</label>
                                <input type="text" class="form-control " id="cvc" name="cvc" placeholder="CVC" maxlength="3">
                              </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Oluştur</button>
                          </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@include('inc.footer')