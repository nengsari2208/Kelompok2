@extends('layout.app')

@section('title', 'Reimbursement Detail')

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

            <h1>Reimbursement Form</h1>
            <div class="user-info">
                <i class="bx bx-user-circle"></i>
                <span>{{ Auth::user()->nama }}</span>
            </div>

        </section>
        
        <section class="main-content shadow section-cards">

            <div class="content-head">
                <a href="/reimbursement">
                    <button class="btn">
                        <i class="bx bx-left-arrow-circle"></i>
                        <span>Kembali</span>
                    </button>
                </a>
            </div>

            <p>Berikut adalah detail dari reimbursement yang diajukan. Silakan lakukan verifikasi.</p><br>
            
                <div class="form-row">

                    <div>
                        <div>
                            <i class="bx bxs-user-rectangle"></i>
                            <span>Data Diri</span>
                        </div>
                        <table>
                            <tr>
                                <td>NIP</td>
                                <td>: {{ $detail->user->nip }}</td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>: {{ $detail->user->nama }}</td>
                            </tr>
                            <tr>
                                <td>Department</td>
                                <td>: {{ $detail->user->department->nama_departemen }}</td>
                            </tr>
                            <tr>
                                <td>Position</td>
                                <td>: {{ $detail->user->position->nama_jabatan }}</td>
                            </tr>
                        </table>
                    </div>

                    <div>
                        <div>
                            <i class="bx bxs-calendar"></i>
                            <span>Periode</span>
                        </div>
                        <table>
                            <tr>
                                <td>From</td>
                                <td>: {{ $detail->from }}</td>
                            </tr>
                            <tr>
                                <td>To</td>
                                <td>: {{ $detail->to }}</td>
                            </tr>
                        </table>
                    </div>

                </div>

                <div class="form-row">

                    <div>
                        <div>
                            <i class="bx bxs-directions"></i>
                            <span>Tujuan</span>
                        </div>
                        {{ $detail->kategori == "perjalanan" ? "Perjalanan Dinas" : ($detail->kategori == "medis" ? "Perawatan Medis" : "Operasional Bisnis") }}
                    </div>

                    <div>
                        <div>
                            <i class="bx bxs-file-archive"></i>
                            <span>Bukti</span>
                        </div>
                        <a href="{{ asset('storage/bukti/'.$detail->bukti) }}" download>BuktiReimbursment.zip</a>
                        
                    </div>

                </div>
                
                <div>

                    <div>
                        <i class="bx bx-list-ul"></i>
                        <span>Daftar Pengeluaran</span>
                    </div>
                    <table class="table" id="tabelForm">
                        <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th>Pengeluaran</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php 
                            $total = 0;
                            function uang($angka){
                                $rupiah = "Rp " . number_format($angka,0,',','.');
                                return $rupiah;
                            }
                        @endphp
                        @foreach($detail->reimbursementDetail as $row)
                        <tr>
                            <td>
                                {{ $row->tanggal }}
                            </td>
                            <td>
                                {{ $row->deskripsi }}
                            </td>
                            <td>
                            {{ uang($row->pengeluaran) }}
                            </td>
                        </tr>
                        @php 
                          $total += $row->pengeluaran;
                        @endphp
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="2">
                            </td>
                            <td>
                                Total : {{ uang($total) }}
                            </td>
                        </tr>
                        </tfoot>
                    </table>

                </div>

                <br>
                <div style="display:flex; gap:10px;">

                    @if($detail->status == "waiting")
                        <form action="/updateStatus" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $detail->id }}">
                            <button type="submit" value="accepted" name="status" class="btn" style="background-color: #4CAF50; max-width: 110px;margin: 0 auto;">
                                <i class="bx bx-check-circle"></i>
                                Accept
                            </button>
                        </form>
                        <form action="/updateStatus" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $detail->id }}">
                            <button type="submit" value="declined" name="status" class="btn" style="background-color:#F44336;max-width: 110px;margin: 0 auto;">
                                <i class="bx bx-x-circle"></i>
                                Decline
                            </button>
                        </form>
                    @else
                        @if($detail->status == "declined")
                            @php $color = "#FF4136"; @endphp
                        @elseif($detail->status == "accepted")
                            @php $color = "#dec733"; @endphp
                        @else
                            @php $color = "#66CDAA"; @endphp
                        @endif
                        <span class="error" style="background-color:{{ $color }};padding: 10px;">Reimbursement {{ ucfirst($detail->status) }}</span>
                    @endif
                    
                </div>
        </section>

    </main>

@endsection
    