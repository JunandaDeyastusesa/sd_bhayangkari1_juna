@extends('layoutDash.main')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $error }}</strong> mohon periksa kembali
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endforeach
                @endif
                <!-- general form elements -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">{{ $title }}</h3>
                    </div>

                    <!-- form start -->
                    <form action="{{ route('BayarSpp.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_siswa" value="{{ $siswa->id }}">
                        <div class="card-body row">
                            <div class="form-group col-sm-6">
                                <label for="nisn">NISN</label>
                                <input type="number" value="{{ $siswa->NISN }}" class="form-control" id="nisn"
                                    readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="nama_siswa">Nama Siswa</label>
                                <input type="text" value="{{ $siswa->nama_siswa }}" class="form-control" id="nama_siswa"
                                    readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="kd_bayar">kd_bayar</label>
                                <input type="number" name="kd_bayar" class="form-control" id="kd_bayar"
                                    placeholder="Masukkan Kode Bayar...">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="bulan">Bulan</label>
                                <select name="bulan" class="form-control" id="bulan">
                                    <option value="">Pilih bulan...</option>
                                    @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $month => $months)
                                        <option value="{{ $months }}">{{ $months }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-sm-3">
                                <label for="tahun">Tahun</label>
                                <select name="tahun" class="form-control" id="tahun">
                                    <option value="">Pilih tahun...</option>
                                    @for ($year = 2010; $year <= date('Y'); $year++)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="jumlah_pembayaran">Nominal</label>
                                <input type="text" name="jumlah_pembayaran" class="form-control" id="jumlah_pembayaran"
                                    placeholder="Masukkan jumlah_pembayaran...">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="bukti_pembayaran">Bukti Bayar</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input name="bukti_pembayaran" type="file" id="bukti_pembayaran" multiple>
                                    </div>
                                </div>
                            </div>

                            <div id="previewContainer">
                                <img id="previewFoto" src="#" alt="Preview Foto"
                                    style="max-width: 300px; max-height: 300px;">
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="button" class="btn btn-outline-secondary" onclick="window.history.back();">Kembali</button>
                            <button type="submit" class="btn btn-info float-right">Submit</button>
                            {{-- <button type="reset" class="btn btn-danger float-right">reset</button> --}}
                        </div>
                    </form>
                </div>


            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <script>
        const inputFoto = document.getElementById('bukti_pembayaran');
        const previewFoto = document.getElementById('previewFoto');

        inputFoto.addEventListener('change', function() {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                reader.addEventListener('load', function() {
                    previewFoto.src = reader.result;
                    previewFoto.style.display = 'block'; // Menampilkan gambar setelah dipilih
                });

                reader.readAsDataURL(file);
            } else {
                previewFoto.src = ""; // Reset gambar
                previewFoto.style.display = 'none'; // Sembunyikan gambar
            }
        });
    </script>
@endsection
