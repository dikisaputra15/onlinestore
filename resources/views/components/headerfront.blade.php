 <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.webp" alt=""> -->
        <h1 class="sitename">GoService</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="{{ url('itservice') }}">IT Service</a></li>
          <li><a href="{{ url('tracking-teknisi') }}">Tracking Service</a></li>
          <li><a href="{{ url('myorder') }}">MyOrder</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <ul>
      </ul>

    @if (Route::has('login'))
         @auth

                <a href="" style="color: white;">Hi, {{auth()->user()->name}}</a>

                <a class="btn btn-danger" ="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Logout</a>
                <form id="logout-form" action="{{route('logout')}}" method="POST" class="d-none">
                    @csrf
                </form>

        @else
            <a class="btn-getstarted" href="/Alllogin">Login</a>

            @if (Route::has('register'))
                <a class="btn-getstarted" href="{{route('register')}}">Register</a>
            @endif
        @endauth

    @endif

    </div>
  </header>
