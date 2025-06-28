<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <center>
        <a href="{{ route('dashboard.index') }}" class="brand-link">
            {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8"> --}}
            <span class="brand-text font-weight-bold">POSYANDU</span>
        </a>
    </center>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/img/avatar2.png" class="img-circle" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('dashboard.index') }}" class="d-block">
                    @if (Auth::user()->role == 'bidan')
                        @if (Auth::user()->bidan)
                            {{ Auth::user()->bidan->nama_bidan }}
                        @endif
                    @elseif (Auth::user()->role == 'ortu')
                        @if (Auth::user()->orangtua)
                            {{ Auth::user()->orangtua->nama_ortu }}
                        @endif
                    @else
                        {{ Auth::user()->username }}
                    @endif
                </a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}"
                        class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                        <i class="fas fa-home nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                @if (auth()->check() && auth()->user()->role == 'admin')
                    <li class="nav-header">Data Master</li>
                    <li class="nav-item">
                        <a href="{{ route('orangtua.index') }}"
                            class="nav-link {{ Request::is('orangtua*') ? 'active' : '' }}">
                            <i class="fas fa-user-friends nav-icon"></i>
                            <p>Data Orang Tua</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('balita.index') }}"
                            class="nav-link {{ Request::is('balita*') ? 'active' : '' }}">
                            <i class="fas fa-child nav-icon"></i>
                            <p>Data Balita</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('bidan.index') }}"
                            class="nav-link {{ Request::is('bidan*') ? 'active' : '' }}">
                            <i class="fas fa-user-md nav-icon"></i>
                            <p>Data Bidan</p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="fas fa-user user-icon nav-icon"></i>
                            <p>Data User</p>
                        </a>
                    </li> --}}
                @endif

                @if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'bidan'))
                    <li class="nav-header">Layanan</li>
                    <li class="nav-item">
                        <a href="{{ route('imunisasi.create') }}"
                            class="nav-link {{ Request::is('imunisasi/create') ? 'active' : '' }}">
                            <i class="fas fa-notes-medical nav-icon"></i>
                            <p>Imunisasi Anak</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('penimbangan.create') }}"
                            class="nav-link {{ Request::is('penimbangan/create') ? 'active' : '' }}">
                            <i class="fas fa-balance-scale nav-icon"></i>
                            <p>Penimbangan Anak</p>
                        </a>
                    </li>
                    <li class="nav-header">Data Pelayanan</li>
                    <li class="nav-item">
                        <a href="{{ route('imunisasi.index') }}"
                            class="nav-link {{ Request::is('imunisasi') ? 'active' : '' }}">
                            <i class="fas fa-notes-medical nav-icon"></i>
                            <p>Data Imunisasi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('penimbangan.index') }}"
                            class="nav-link {{ Request::is('penimbangan') ? 'active' : '' }}">
                            <i class="fas fa-balance-scale nav-icon"></i>
                            <p>Data Penimbangan</p>
                        </a>
                    </li>

                    <li class="nav-header">Persediaan</li>
                    <li class="nav-item">
                        <a href="{{ route('vaksin.index') }}"
                            class="nav-link {{ Request::is('vaksin*') ? 'active' : '' }}">
                            <i class="fas fa-syringe nav-icon"></i>
                            <p>Data Vaksin</p>
                        </a>
                    </li>
                @endif

                @if (
                    (auth()->check() && auth()->user()->role == 'admin') ||
                        auth()->user()->role == 'bidan' ||
                        auth()->user()->role == 'ortu')
                    <li class="nav-header">Jadwal</li>
                    <li class="nav-item">
                        <a href="{{ route('jadwal.index') }}"
                            class="nav-link {{ Request::is('jadwal*') ? 'active' : '' }}">
                            <i class="fas fa-bell notification-icon nav-icon"></i>
                            <p>Notifikasi dan Pengingat</p>
                        </a>
                    </li>
                @endif

                <li class="nav-header">----------------------------------------------</li>
                <li class="nav-item mb-3">
                    <a href="{{ route('logout') }}" class="nav-link logout-btn"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Keluar</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const logoutBtn = document.querySelector('.logout-btn');
        logoutBtn.addEventListener('click', function() {
            logoutBtn.classList.add('disabled');
        });
    });
</script>
