	<!-- Header -->
	<header class="header shop">
		
		<div class="middle-inner">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 col-md-2 col-12">
						<!-- Logo -->
						<div class="logo">
							<a href="/"><img src="{{ asset('eshop/images/logo.png') }}" alt="logo"></a>
						</div>
						<!--/ End Logo -->
						<!-- Search Form -->
						<div class="search-top">
							<div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
							<!-- Search Form -->
							<div class="search-top">
								<form class="search-form">
									<input type="text" placeholder="Search here..." name="search">
									<button value="search" type="submit"><i class="ti-search"></i></button>
								</form>
							</div>
							<!--/ End Search Form -->
						</div>
						<!--/ End Search Form -->
						<div class="mobile-nav"></div>
					</div>
					<div class="col-lg-6 col-md-7 col-12">
						<div class="search-bar-top">
							<div class="search-bar">
								<form action="/cariproduk" method="POST">
									@csrf
									<input name="cari" placeholder="Cari Nama Produk disini....." type="search">
									<button class="btnn"><i class="ti-search"></i></button>
								</form>
							</div>
						</div>
					</div>
                    @if (Route::has('login'))
                        <div class="col-lg-4 col-md-3 col-12">
                            <div class="right-bar">
                                <!-- Search Form -->
                                @auth
                                	<div class="sinlge-bar">
                                        <a href="/pesanan">Pesanan</a>
                                    </div>
                                    <div class="sinlge-bar">
                                        <p>Hi, {{auth()->user()->name}}</p>
                                    </div>
                                    <div class="sinlge-bar shopping">
                                    	@php
                                    		$id = auth()->user()->id;
							            	$countker = DB::table('keranjangs')->where('id_user', $id)->count();
							        	@endphp
                                        <a href="/allkeranjang" class="single-icon"><i class="ti-bag"></i> <span class="total-count">{{$countker}}</span></a>
                                    </div>
                                    <div class="sinlge-bar">
                                        <i class="ti-power-off"></i><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Logout</a>
                                        <form id="logout-form" action="{{route('logout')}}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                @else
                                    <div class="sinlge-bar">
                                        <i class="ti-power-off"></i><a href="/Alllogin">Login</a>
                                    </div>
                                    @if (Route::has('register'))
                                        <div class="sinlge-bar">
                                            <i class="ti-user"></i> <a href="{{route('register')}}">Register</a>
                                        </div>
                                    @endif
                                
                                @endauth
                            </div>
                        </div>
                    @endif
				</div>
			</div>
		</div>
		<!-- Header Inner -->
		<div class="header-inner">
			<div class="container">
				<div class="cat-nav-head">
					<div class="row">
						<div class="col-lg-3">
							<div class="all-category">
								<h3 class="cat-heading"><i class="fa fa-bars" aria-hidden="true"></i>CATEGORIES</h3>
								<ul class="main-category">
									 @php
							            $kategoris = DB::table('kategoris')->get();
							        @endphp

							        @foreach ($kategoris as $kategori)
										<li><a href="/kategori/{{$kategori->id}}/pilihkategori">{{$kategori->nama_kategori}}</a></li>
									@endforeach
								</ul>
							</div>
						</div>
						<div class="col-lg-9 col-12">
							<div class="menu-area">
								<!-- Main Menu -->
								<nav class="navbar navbar-expand-lg">
									<div class="navbar-collapse">	
										<div class="nav-inner">	
											<ul class="nav main-menu menu navbar-nav">
													<li class="active"><a href="/">Home</a></li>												
													<li><a href="/contact">Contact Us</a></li>
												</ul>
										</div>
									</div>
								</nav>
								<!--/ End Main Menu -->	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Header Inner -->
	</header>
	<!--/ End Header -->