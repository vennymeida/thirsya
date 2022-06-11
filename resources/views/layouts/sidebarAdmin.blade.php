<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="https://www.creative-tim.com" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="../assets/img/WaroenkQu.png">
          </div>
          <!-- <p>CT</p> -->
        </a>
        <a href="https://www.creative-tim.com" class="simple-text logo-normal">
          WaroenkQu
          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class=" nav-item {{ set_active('admin') }}">
            <a class="nav-link" href="{{ route('admin') }}">
              <i class="nc-icon nc-bank"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class=" nav-item {{ set_active('Adminprofil') }}">
            <a class="nav-link" href="{{ route('Adminprofil') }}">
              <i class="nc-icon nc-single-02"></i>
              <p>Admin Profile</p>
            </a>
          </li>
          <li class=" nav-item {{ set_active('barang') }}">
            <a class="nav-link" href='\barang'>
              <i class="nc-icon nc-tile-56"></i>
              <p>List Barang</p>
            </a>
          </li>
          <li class=" nav-item {{ set_active('Adminpembeli') }}">
            <a class="nav-link" href="{{ route('Adminpembeli') }}">
              <i class="nc-icon nc-tile-56"></i>
              <p>List Pembeli</p>
            </a>
          </li>
          <li class=" nav-item {{ set_active('Admintransaksi') }}">
            <a class="nav-link" href="{{ route('Admintransaksi') }}">
              <i class="nc-icon nc-tile-56"></i>
              <p>List Transaksi</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">