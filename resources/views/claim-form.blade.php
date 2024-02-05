@extends('layout.app')

@section('title', 'Reimbursement Form')

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
                @if ($errors->any())
                    <div class="error">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <form action="/claim" method="post" enctype="multipart/form-data">
                @csrf
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
                                <td><input type="date" name="from" id="" value="{{ old('from') }}" required></td>
                            </tr>
                            <tr>
                                <td>To</td>
                                <td><input type="date" name="to" id="" value="{{ old('to') }}" required></td>
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
                        <select name="kategori" id="" required>
                            <option value="" selected disabled>- Pilih Kategori -</option>
                            <option value="perjalanan" {{ old('kategori') == "perjalanan" ? 'selected' : '' }}>Perjalanan Dinas</option>
                            <option value="medis" {{ old('kategori') == "medis" ? 'selected' : '' }}>Kebutuhan Medis</option>
                            <option value="operasional" {{ old('kategori') == "operasional" ? 'selected' : '' }}>Operasional Bisnis</option>
                        </select>
                    </div>

                    <div>
                        <div>
                            <i class="bx bxs-file-archive"></i>
                            <span>Upload Bukti</span>
                        </div>
                        <span>*file bukti disatukan menjadi .zip</span><br>
                        <input type="file" name="bukti" id="" value="{{ old('bukti') }}" accept=".zip, .rar" required>
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
                        @if( old('tanggal') )

                            @for ($i = 0; $i < count(old('tanggal')); $i++)

                            <tr>
                                <td>
                                    <input type="date" name="tanggal[]" id="" value="{{ old('tanggal.'.$i) }}" required>
                                </td>
                                <td>
                                    <input type="text" name="deskripsi[]" value="{{ old('deskripsi.'.$i) }}" required>
                                </td>
                                <td>
                                    <input type="number" name="pengeluaran[]" id="" value="{{ old('pengeluaran.'.$i) }}" required onkeyup="total();">
                                </td>
                            </tr>

                            @endfor

                        @else
                        <tr>
                            <td>
                                <input type="date" name="tanggal[]" id="" value="{{ old('tanggal[]') }}" required>
                            </td>
                            <td>
                                <input type="text" name="deskripsi[]" value="{{ old('deskripsi[]') }}" required>
                            </td>
                            <td>
                                <input type="number" name="pengeluaran[]" id="" value="{{ old('pengeluaran[]') }}" required onkeyup="total();">
                            </td>
                        </tr>
                        @endif
                        
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="2">
                                <i onclick="addRow()" class="bx bx-plus-circle"></i>
                                <i onclick="delRow()" class="bx bx-minus-circle"></i>
                            </td>
                            <td>
                                Total : <span id="total"></span>
                            </td>
                        </tr>
                        <tfoot>
                    </table>

                </div>

                <br>
                
                <div class="content-head">
                    <button type="submit" class="btn" style="max-width: 110px;margin: 0 auto;">
                        <i class="bx bx-check-circle"></i>
                        <span>Submit</span>
                    </button>
                </div>

            </form>
        </section>

    </main>
    <script>
        console.log(document.getElementsByName('pengeluaran[]').length)
        function addRow() {
            //get Element
            var table = document.getElementById("tabelForm");
            //add 1 Row dari belakang
            var row = table.insertRow(table.rows.length - 1);
            //add 3 cell
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            //add input tag kedalam cell
            cell1.innerHTML = '<input type="date" name="tanggal[]" value="{{ old('pengeluaran[]') }}"/>';
            cell2.innerHTML = '<input type="text" name="deskripsi[]" value="{{ old('pengeluaran[]') }}"/>';
            cell3.innerHTML = '<input type="number" name="pengeluaran[]" value="{{ old('pengeluaran[]') }}" onkeyup="total();"/>';
        }
        function delRow() {
            //get Element
            var table = document.getElementById("tabelForm");
            //delete 1 Row dari belakang
            var row = table.deleteRow(table.rows.length - 1);
        }
        function formatUang(angka) {
            let reverse = angka.toString().split("").reverse().join("");
            let ribuan = reverse.match(/\d{1,3}/g);
            let hasil = ribuan.join(".").split("").reverse().join("");
            if(hasil){
                return hasil;
            } else {
                return;
            }
            
        }
        function total(){
            let element = document.getElementsByName('pengeluaran[]');
            let totalElement = document.getElementById('total');
            let total = 0;
            element.forEach((v)=>{ 
                total += parseInt(v.value)
                if(total){
                    totalElement.innerHTML = formatUang(total)
                } else {
                    totalElement.innerHTML = ""
                }
            });
        }
    </script>
@endsection
    