@include('inc.header')
@include('inc.menu')
<div class="content-page">
    <div class="container">
    @include('inc.head')
      <div class="row align-items-center my-4">
            <div class="col-6">
                <h5 class="page-title text-secondary mb-0">Hesaplar</h5>
            </div>
            <div class="col-6 text-end">
                <a href="{{url('account/create')}}" class="btn btn-primary text-right mb-0">Yeni Hesap Oluştur</a>
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
                                <th scope="col" style="white-space: nowrap">İsim</th>
                                <th scope="col" style="white-space: nowrap">Bayi Id</th>
                                <th scope="col" style="white-space: nowrap">Api Key</th>
                                <th scope="col" style="white-space: nowrap">Secret Key</th>
                                <th scope="col" style="white-space: nowrap">Oluşturulma Tarihi</th>
                                <th scope="col" style="white-space: nowrap">İşlemler</th>
                              </tr>
                            </thead>
                            <tbody>
                              @if (count($accounts) > 0 )
                              @foreach ($accounts as $key => $item)
                              <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->dealerId}}</td>
                                <td>{{$item->apiKey}}</td>
                                <td>{{$item->secretKey}}</td>
                                <td>{{$item->created_at}}</td>
                                <td class="table-action">
                                  <a href="{{url('account/detail')}}/{{$item->id}}"   class="action-icon text-primary mx-1 "> <i class="bi bi-pencil-square"></i></a>
                                  <a href="javascript:void(0)" data-id="{{$item->id}}" class="action-icon text-danger mx-1 delete-account"> <i class="bi bi-trash"></i></a>
                                </td>
                              </tr>
                              @endforeach
                              @else
                              <tr>
                                <td colspan="7" class="text-center  p-3">Görüntülenecek hesap bulunamadı.</td>
                              </tr>
                              @endif
                          
                         
                            </tbody>
                          </table>
                        </div>
                          <div class="table-responsive d-flex justify-content-center custom-paginate">
                            {{$accounts->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@include('inc.footer')
@include('Accounts.footer')