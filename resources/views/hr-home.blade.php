@extends('layout.app')

@section('title', 'Home Page')

@section('nav-menu')
    
    <nav>
        <a href="/home">
            <div class="nav-item on-page">
                <i class='bx bx-home'></i>
                <span>Home</span>
            </div>
        </a>
        <a href="/reimbursement">
            <div class="nav-item">
                <i class="bx icon-gui-refund"></i>
                <span>Reimbursement</span>
            </div>
        </a>
    </nav> 

@endsection

@section('content')
    
    <main class="content">

        <section class="head-info shadow section-cards">
            <h1>Selamat Datang</h1>
            <div class="user-info">
                <i class="bx bx-user-circle"></i>
                <span>
                    {{ Auth::user()->nama }}
                    
                </span>
            </div>
        </section>

        <section class="main-content shadow section-cards">
            <div class="content-head">
                <div class="content-title">
                    <i class="bx bx-info-circle"></i>
                    <h2>Description</h2>
                </div>
            </div>
            
            <p>
                Ini adalah aplikasi reimbursement pada PT Kelompok 2 KA7A Indonesia.
                <br><br>
                Anda sebagai HR dapat melakukan verifikasi atau pemeriksaan terhadap pengajuan reimbursement. Anda dapat melihat semua pengajuan  beserta detail  dan bukti - bukti nya  pada halaman reimbursement,  lalu 
                buatlah keputusan apakah pengajuan diterima atau ditolak.

            </p>
        </section>

    </main>

@endsection





    
