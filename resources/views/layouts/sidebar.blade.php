 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="{{asset('AdminLTE')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Goservice</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">Hi, {{auth()->user()->name}}</li>
          <li class="nav-item menu-open">
            <a href="/dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ Route('user.index') }}" class="nav-link">
              <i class="nav-icon far fa-user"></i>
              <p>
                Management User
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ Route('lokasi.index') }}" class="nav-link">
              <i class="nav-icon far fa-user"></i>
              <p>
                Data Lokasi
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ Route('tarif.index') }}" class="nav-link">
              <i class="nav-icon far fa-file"></i>
              <p>
                Tarif
              </p>
            </a>
          </li>

           <li class="nav-item">
            <a href="{{ Route('jeniskerusakan.index') }}" class="nav-link">
              <i class="nav-icon far fa-file"></i>
              <p>
                Jenis Kerusakan
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('pesananmasuk')}}" class="nav-link">
              <i class="nav-icon far fa-file"></i>
              <p>
                Pesanan Masuk
              </p>
            </a>
          </li>

           <li class="nav-item">
            <a href="{{url('dataservice')}}" class="nav-link">
              <i class="nav-icon far fa-file"></i>
              <p>
                Data Service Selesai
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('laporan')}}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Laporan Pendapatan
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
