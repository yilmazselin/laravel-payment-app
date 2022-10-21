@include('inc.header')
@include('inc.menu')
<div class="content-page">
    <div class="container">
    @include('inc.head')
      <div class="row align-items-center my-4">
            <div class="col-6">
                <h5 class="page-title text-secondary mb-0">Kartlar</h5>
            </div>
            <div class="col-6 text-end">
                <a href="{{url('card/create')}}" class="btn btn-primary text-right mb-0">Yeni Kart Oluştur</a>
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
                                <th scope="col" style="white-space: nowrap">Kart Sahibi</th>
                                <th scope="col" style="white-space: nowrap">Kart Numarası</th>
                                <th scope="col" style="white-space: nowrap">Son Kullanma Tarihi</th>
                                <th scope="col" style="white-space: nowrap">CVC</th>
                                <th scope="col" style="white-space: nowrap">Oluşturulma Tarihi</th>
                                <th scope="col" style="white-space: nowrap">İşlemler</th>
                              </tr>
                            </thead>
                            <tbody>
                              @if (count($cards) > 0 )
                              @foreach ($cards as $key => $item)
                              <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->holderName}}</td>
                                <td>{{$item->cardNumber}}</td>
                                <td>{{$item->expiryMonth."/".$item->expiryYear}}</td>
                                <td>{{$item->cvc}}</td>
                                <td>{{$item->created_at}}</td>
                                <td class="table-action">
                                  <a href="{{url('card/detail')}}/{{$item->id}}"   class="action-icon text-primary mx-1 "> <i class="bi bi-pencil-square"></i></a>
                                  <a href="javascript:void(0)" data-id="{{$item->id}}" class="action-icon text-danger mx-1 delete-card"> <i class="bi bi-trash"></i></a>
                                </td>
                              </tr>
                              @endforeach
                              @else
                              <tr>
                                <td colspan="7" class="text-center  p-3">Görüntülenecek kart bulunamadı.</td>
                              </tr>
                              @endif
                          
                         
                            </tbody>
                          </table>
                        </div>
                          <div class="table-responsive d-flex justify-content-center custom-paginate">
                            {{$cards->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@include('inc.footer')
@include('Cards.footer')