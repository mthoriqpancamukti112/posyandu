@extends('layout.be.template')
@section('title', 'Data Imunisasi Anak')
@section('styles')
    <link rel="stylesheet" href="/backend/plugins/selectric/public/selectric.css">
    <link rel="stylesheet" href="/backend/plugins/bootstrap-daterangepicker/daterangepicker.css">
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('imunisasi.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="balitas" class="form-label">Nama Anak</label>
                                        <select class="form-control select2 @error('balita_id') is-invalid @enderror"
                                            id="balita_id" name="balita_id" style="width: 100%">
                                            <option value="" selected disabled>--Pilih Anak--</option>
                                            @foreach ($balitas as $balita)
                                                <option value="{{ $balita->id }}"
                                                    data-jenis_kelamin="{{ $balita->jenis_kelamin }}"
                                                    data-nama_ortu="{{ $balita->orangtuas->nama_ortu }}"
                                                    data-tgl_lahir="{{ $balita->tgl_lahir }}">
                                                    {{ $balita->nama_anak }}
                                                    @if ($balita->sudah_imunisasi)
                                                        (Sudah Imunisasi)
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('balita_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_ortu" class="form-label">Nama Orang Tua</label>
                                        <input type="text" class="form-control" id="nama_ortu" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="text" class="form-control" id="tgl_lahir" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                        <input type="text" class="form-control" id="jenis_kelamin" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="usia">Usia</label>
                                        <input id="usia" type="text"
                                            class="form-control @error('usia') is-invalid @enderror" name="usia"
                                            value="{{ old('usia') }}" readonly>
                                        @error('usia')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal" class="form-label">Tanggal Imunisasi</label>
                                        <input id="tanggal" type="text" class="form-control datepicker" name="tanggal"
                                            value="{{ old('tanggal') }}" readonly>
                                        @error('tanggal')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="kondisi">Kondisi</label>
                                        <select name="kondisi" id="kondisi"
                                            class="form-control selectric @error('kondisi') is-invalid @enderror">
                                            <option value="" selected disabled>--Pilih Kondisi--</option>
                                            <option value="Y" {{ old('kondisi') == 'Y' ? 'selected' : '' }}>
                                                Bisa Di Vaksin
                                            </option>
                                            <option value="T" {{ old('kondisi') == 'T' ? 'selected' : '' }}>
                                                Tidak Bisa Di Vaksin
                                            </option>
                                        </select>
                                        @error('kondisi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group vaksin-section">
                                        <label for="vaksin_id">Imunisasi</label>
                                        <select name="vaksin_id" id="vaksin_id" class="form-control select2"
                                            style="width: 100%">
                                            <option value="" selected disabled>--Pilih Jenis Imunisasi--</option>
                                            @foreach ($vaksins as $vaksin)
                                                <option value="{{ $vaksin->id }}" data-stok="{{ $vaksin->stok }}">
                                                    @if ($vaksin->stok == '0')
                                                        (Stock Habis)
                                                        &nbsp;{{ $vaksin->jenis_vaksin }}
                                                    @else
                                                        {{ $vaksin->jenis_vaksin }}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('vaksin_id')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group stok-vaksin-section">
                                        <label for="stok_vaksin">Stok Vaksin</label>
                                        <input id="stok_vaksin" type="text" class="form-control" readonly>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>
@endsection

@section('scripts')
    <!-- Date Range Picker JS -->
    <script src="/backend/plugins/bootstrap-daterangepicker/moment.min.js"></script>
    <script src="/backend/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Select2 -->
    <script src="/backend/plugins/select2/js/select2.full.min.js"></script>
    <!-- Custom Script for Select2 -->
    <script>
        $(function() {
            $(".select2").select2();
        });
    </script>
    <script src="/backend/plugins/selectric/public/jquery.selectric.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tanggal').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'YYYY-MM-DD'
                },
                startDate: moment()
            });

            $('#vaksin_id').change(function() {
                var selectedOption = $('option:selected', this);
                var selectedStok = selectedOption.data('stok');

                $('#stok_vaksin').val(selectedStok);
            });

            $('#balita_id').change(function() {
                var selectedOption = $('option:selected', this);
                var selectedJk = selectedOption.data('jenis_kelamin');
                var selectedOrtu = selectedOption.data('nama_ortu');
                var selectedTglLahir = new Date(selectedOption.data('tgl_lahir'));

                // Convert gender code to full text
                selectedJk = (selectedJk === 'L') ? 'Laki-laki' : (selectedJk === 'P') ? 'Perempuan' :
                    selectedJk;

                // Format date of birth
                var formattedTglLahir = formatDate(selectedTglLahir);

                // Calculate age
                var usia = calculateAge(selectedTglLahir);

                // Display the information
                $('#jenis_kelamin').val(selectedJk);
                $('#nama_ortu').val(selectedOrtu);
                $('#tgl_lahir').val(formattedTglLahir);
                $('#usia').val(formatAge(usia));
            });

            function formatDate(date) {
                var options = {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                };
                return date.toLocaleDateString('id-ID', options);
            }

            function calculateAge(tgl_lahir) {
                var currentDate = new Date();
                var ageInMilliseconds = currentDate - tgl_lahir;

                var ageInYears = Math.floor(ageInMilliseconds / (365.25 * 24 * 60 * 60 * 1000));
                var ageInMonths = Math.floor((ageInMilliseconds % (365.25 * 24 * 60 * 60 * 1000)) / (30.44 * 24 *
                    60 * 60 * 1000));
                var ageInDays = Math.floor((ageInMilliseconds % (30.44 * 24 * 60 * 60 * 1000)) / (24 * 60 * 60 *
                    1000));

                return {
                    years: ageInYears,
                    months: ageInMonths,
                    days: ageInDays
                };
            }

            function formatAge(usia) {
                var formattedAge = '';

                if (usia.years > 0) {
                    formattedAge += usia.years + ' tahun ';
                }

                if (usia.months > 0) {
                    formattedAge += usia.months + ' bulan ';
                }

                if (usia.days > 0) {
                    formattedAge += usia.days + ' hari';
                }

                return formattedAge.trim();
            }
        });

        $(document).ready(function() {
            // Menggunakan event change untuk mendeteksi perubahan pada dropdown "Kondisi"
            $('#kondisi').change(function() {
                // Mendapatkan nilai dropdown yang dipilih
                var selectedKondisi = $(this).val();

                // Menampilkan atau menyembunyikan elemen-elemen berdasarkan nilai dropdown
                if (selectedKondisi === 'Y') {
                    $('.vaksin-section').show();
                    $('.stok-vaksin-section').show();
                } else {
                    $('.vaksin-section').hide();
                    $('.stok-vaksin-section').hide();
                }
            });

            // Inisialisasi berdasarkan kondisi awal
            $('#kondisi').trigger('change');
        });
    </script>
@endsection
