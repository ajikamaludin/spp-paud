<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    <li class="nav-item">
                        <a href="{{ route('web.index') }}" class="nav-link {{ set_active(['web.index'], 'active') }}">
                            <i class="fe fe-home"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#!" class="nav-link {{ set_active(['transaksispp.*'], 'active') }}">
                            <i class="fe fe-repeat"></i> Transaksi SPP
                        </a>
                    </li>
                    <li class="nav-item">
                            <a href="{{ route('tabungan.index') }}" class="nav-link {{ set_active(['tabungan.*'], 'active') }}">
                            <i class="fe fe-repeat"></i> Tabungan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#!" class="nav-link">
                            <i class="fe fe-repeat"></i> Keuangan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('tagihan.index') }}" class="nav-link {{ set_active(['tagihan.*'], 'active') }}">
                            <i class="fe fe-box"></i> Tagihan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('siswa.index') }}" class="nav-link {{ set_active(['siswa.*'], 'active') }}">
                            <i class="fe fe-users"></i> Siswa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('kelas.index') }}" class="nav-link {{ set_active(['kelas.*'], 'active') }}">
                            <i class="fe fe-box"></i>Kelas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('periode.index') }}" class="nav-link {{ set_active(['periode.*'], 'active') }}">
                            <i class="fe fe-box"></i> Periode
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#!" class="nav-link">
                            <i class="fe fe-folder"></i> Kuitansi
                        </a>
                    </li>
                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'SuperAdmin')
                    <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="nav-link {{ set_active(['user.*'], 'active') }}">
                            <i class="fe fe-box"></i> Pengguna
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>