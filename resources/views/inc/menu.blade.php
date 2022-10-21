
<body class="min-vh-100 vh-100">
  
  <div class="d-flex flex-column flex-shrink-0 p-3 bg-aside h-100 " style="width: 280px;float:left">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
      <img src="{{config('app.asset_url')}}images/elestas-logo.png" class="dashboard_logo" alt="">
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="{{url('/payments')}}" class="nav-link  {{$page == "payment" ? "active bg-aside-button" : "link-dark"}}" aria-current="page">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
          İşlemler 
        </a>
      </li>
      <li>
        <a href="{{url('/accounts')}}" class="nav-link  {{$page == "account" ? "active bg-aside-button" : "link-dark"}}">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
          Hesaplar
        </a>
      </li>
      <li>
        <a href="{{url('/cards')}}" class="nav-link link-dark {{$page == "cards" ? "active bg-aside-button" : "link-dark"}}">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
          Kartlar
        </a>
      </li>
      <li>
        <a href="{{url('/payment/create')}}" class="nav-link link-dark {{$page == "createPayment" ? "active bg-aside-button" : "link-dark"}}">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
          Ödeme Çek
        </a>
      </li>
    </ul>
    <hr>
    
  </div>
