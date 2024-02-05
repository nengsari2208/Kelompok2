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

            <p>Silakan lengkapi formulir dibawah ini untuk mengajukan reimbursement.</p><br>
            
                <div class="form-row">

                    <div>
                        <div>
                            <i class="bx bxs-user-rectangle"></i>
                            <span>Data Diri</span>
                        </div>
                        <table>
                            <tr>
                                <td>NIP</td>
                                <td>: {{ Auth::user()->nip }}</td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>: {{ Auth::user()->nama }}</td>
                            </tr>
                            <tr>
                                <td>Department</td>
                                <td>: {{ Auth::user()->department->nama_departemen }}</td>
                            </tr>
                            <tr>
                                <td>Position</td>
                                <td>: {{ Auth::user()->position->nama_jabatan }}</td>
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
                                <td>{{ $detail->from }}</td>
                            </tr>
                            <tr>
                                <td>To</td>
                                <td>{{ $detail->to }}</td>
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
                        <thead>
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
                        <tbody>
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
                
                <div style="display:flex; gap:10px; flex-direction: column;">

                    @if($detail->status == "waiting")
                        <span class="error" style="background-color:grey;padding: 10px;">Reimbursement {{ ucfirst($detail->status) }} Verification</span>
                        <form action="/cancelClaim" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $detail->id }}">
                            <button type="submit" value="cancel" name="status" class="btn" style="background-color: #F44336; max-width: fit-content;">
                                <i class="bx bx-x-circle"></i>
                                Cancel Claim
                            </button>
                        </form>
                    @elseif($detail->status == "accepted")
                        <span class="error" style="background-color:#dec733;padding: 10px;">Reimbursement {{ ucfirst($detail->status) }}, Please contact finance department to claiming your reimbursement</span>
                    @elseif($detail->status == "declined")
                        <span class="error" style="background-color:#F44336;padding: 10px;">Reimbursement {{ ucfirst($detail->status) }}</span>
                    @elseif($detail->status == "claimed")
                        <span class="error" style="background-color:#66CDAA;padding: 10px;">Reimbursement {{ ucfirst($detail->status) }}</span>
                    @endif
                    
                </div>

            
        </section>

    </main>

@endsection
    