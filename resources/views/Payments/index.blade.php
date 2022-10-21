@include('inc.header')
@include('inc.menu')
<div class="content-page">
    <div class="container">
    @include('inc.head')
      <div class="row align-items-center my-4">
            <div class="col-6">
                <h5 class="page-title text-secondary mb-0">İşlemler</h5>
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                      <div class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th scope="col" style="white-space: nowrap">Id</th>
                                <th scope="col" style="white-space: nowrap">Tutar</th>
                                <th scope="col" style="white-space: nowrap">weepay Order Id</th>
                                <th scope="col" style="white-space: nowrap">Kart Sahibi</th>
                                <th scope="col" style="white-space: nowrap">Hesap Adı</th>
                                <th scope="col" style="white-space: nowrap">İşlem Tarihi</th>
                              </tr>
                            </thead>
                            <tbody>
                              @if (count($payments) > 0 )
                              @foreach ($payments as $key => $item)
                              <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->weepayOrderId}}</td>
                                <td>{{$item->holderName}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->created_at}}</td>
                              </tr>
                              @endforeach
                              @else
                              <tr>
                                <td colspan="7" class="text-center  p-3">Görüntülenecek işlem bulunamadı.</td>
                              </tr>
                              @endif
                          
                         
                            </tbody>
                          </table>
                        </div>
                          <div class="table-responsive d-flex justify-content-center custom-paginate">
                            {{$payments->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@include('inc.footer')