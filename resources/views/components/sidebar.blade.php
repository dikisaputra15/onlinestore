<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ Route('dashboard') }}">Admin Store</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ Route('dashboard') }}">AS</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>

            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="far fa-file-alt"></i><span>Master Data</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link"
                            href="{{ Route('user.index') }}">Management User</a>
                    </li>
                    <li>
                        <a class="nav-link"
                            href="{{ Route('kategori.index') }}">Kategori</a>
                    </li>
                    <li>
                        <a class="nav-link"
                            href="{{ Route('produk.index') }}">Produk</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="far fa-file-alt"></i><span>Pesanan</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link"
                            href="/pesananmasuk">Pesanan Biasa</a>
                    </li>
                    <li>
                        <a class="nav-link"
                            href="/pomasuk">PO</a>
                    </li>
                </ul>
            </li>


            <li class="nav-item">
                <a href="/admintransaksi" class="nav-link"><i class="fas fa-th-large"></i><span>Pembayaran Sukses</span></a>
            </li>

            <li class="nav-item">
                <a href="/adminpengiriman" class="nav-link"><i class="fas fa-th-large"></i><span>Data Pengiriman</span></a>
            </li>

            <li class="nav-item">
                <a href="/lappenjualan" class="nav-link"><i class="fas fa-th-large"></i><span>Laporan Penjualan</span></a>
            </li>

        </ul>
    </aside>
</div>
