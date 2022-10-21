@include('inc.header')
@include('inc.menu')
<div class="content-page">
    <div class="container">
    @include('inc.head')
      <div class="row align-items-center my-4">
            <div class="col-6">
                <h5 class="page-title text-secondary mb-0">Ödeme Çek</h5>
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
                    <form class="row g-3" action="{{url('/payment/store')}}" method="POST">
                      @csrf
                        <div class="col-md-6">
                            <label for="accountId" class="form-label">Ödeme Yapılacak Şirket</label>
                            <select id="accountId" name="accountId" class="form-select">
                              <option value="0">Seçiniz</option>
                              @foreach ($accounts as $key => $value)
                              <option value="{{$value->id}}">{{$value->name}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-md-6">
                            <label for="creditCardId" class="form-label">Ödeme Yapılacak Kart</label>
                            <select id="creditCardId" name="creditCardId" class="form-select">
                              <option  value="0">Seçiniz</option>
                              @foreach ($cards as $key => $value)
                              <option value="{{$value->id}}">{{$value->holderName}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-md-6">
                            <label for="price" class="form-label">Ödeme Yapılacak Tutar</label>
                            <input class="form-control " id="price" name="price" placeholder="0.00"  inputmode="decimal"  style="text-align: right;">
                          </div>
                        <div class="col-12">
                          <div class="form-check">
                            <input checked class="form-check-input" name="threedSecure" type="checkbox" id="threedSecure">
                            <label class="form-check-label" for="threedSecure">
                              3D Secure ile öde
                            </label>
                          </div>
                        </div>
                        <div class="col-12">
                          <button type="submit" class="btn btn-primary">Ödeme Çek</button>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>

    </div>
</div>
@include('inc.footer')
@include('CreatePayment.footer')