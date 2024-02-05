@extends('layout.app')

@section('title', 'Reimbursement Page')

@section('nav-menu')
    <nav>
        <a href="/home">
            <div class="nav-item">
                <i class='bx bx-home'></i>
                <span>Home</span>
            </div>
        </a>
        <a href="/reimbursement">
            <div class="nav-item on-page">
                <i class="bx icon-gui-refund"></i>
                <span>Reimbursement</span>
            </div>
        </a>
    </nav> 
@endsection

@section('content')

    <main class="content">

        <section class="head-info shadow section-cards">
            <h1>Reimbursement Page</h1>
            <div class="user-info">
                <i class="bx bx-user-circle"></i>
                <span>{{ Auth::user()->nama }}</span>
            </div>
        </section>

        <section class="main-content shadow section-cards">
            <div class="content-head">
                <div class="content-title">
                    <i class="bx bx-info-circle"></i>
                    <h2>Daftar Pengajuan Reimbursement</h2>
                </div>

                <!-- <a href="/claim">
                    <button class="btn">
                        <i class="bx bx-plus-circle"></i>
                        <span>Tambah</span>
                    </button>
                </a> -->
            </div>
            
        @if(count($reimbursement) > 0)
            <p>
                Berikut adalah daftar pengajuan reimbursement dimulai dari yang belum ter-verifikasi.
            </p>

            <br><br>
            <table class="table">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>#</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $num = 1;
                @endphp
                @foreach ($reimbursement as $row)
                    <tr>
                        <td>{{ $num++ }}</td>
                        <td>{{ $row->user->nama }}</td>
                        <td>{{ $row->kategori == "perjalanan" ? "Perjalanan Dinas" : ($row->kategori == "medis" ? "Perawatan Medis" : "Operasional Bisnis") }}</td>
                        <td>{{ ucfirst($row->status) }}</td>
                        <td><a href="/reimbursement/{{ $row->id }}">Detail</a></td>
                    </tr>
                    @php
                        if($row->kategori == "perjalanan"){
                            echo "Perjalanan Dinas";
                        } elseif($row->kategori == "medis"){
                            echo "Perawatan Medis";
                        } else {
                            echo "Operasional Bisnis";
                        }
                    @endphp
                @endforeach
                </tbody>
            </table>
        
        @else
            <p>Belum ada data pengajuan claim reimbursement untuk ditampilkan</p>
        @endif
        </section>

    </main>

@endsection
    