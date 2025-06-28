@extends('layout.be.template')
@section('title', 'Data Penimbangan Anak')
@section('styles')
    <link rel="stylesheet" href="/backend/plugins/selectric/public/selectric.css">
    <link rel="stylesheet" href="/backend/plugins/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="/backend/plugins/summernote/dist/summernote-bs4.css">
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('penimbangan.store') }}" method="POST">
                            @csrf
                            <div class="row">
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
                                                    {{ $balita->nama_anak }}</option>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tgl_timbang">Tanggal Penimbangan</label>
                                        <input id="tgl_timbang" type="text" class="form-control datepicker"
                                            name="tgl_timbang" value="{{ old('tgl_timbang') }}" readonly>
                                        @error('tgl_timbang')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="berat_badan">Berat Badan (Kg)</label>
                                        <input id="berat_badan" type="number"
                                            class="form-control @error('berat_badan') is-invalid @enderror"
                                            name="berat_badan" value="{{ old('berat_badan') }}">
                                        @error('berat_badan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="tinggi_badan">Tinggi Badan (Cm)</label>
                                        <input id="tinggi_badan" type="number"
                                            class="form-control @error('tinggi_badan') is-invalid @enderror"
                                            name="tinggi_badan" value="{{ old('tinggi_badan') }}">
                                        @error('tinggi_badan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="perkembangan">Perkembangan</label>
                                        <select name="perkembangan" id="perkembangan"
                                            class="form-control selectric @error('perkembangan') is-invalid @enderror">
                                            <option value="" selected disabled>--Pilih Perkembangan--
                                            </option>
                                            <option value="Y" {{ old('perkembangan') == 'Y' ? 'selected' : '' }}>
                                                Sesuai
                                            </option>
                                            <option value="T" {{ old('perkembangan') == 'T' ? 'selected' : '' }}>
                                                Tidak
                                            </option>
                                        </select>
                                        @error('perkembangan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group" id="keterangan-container" style="display: none;">
                                        <label for="keterangan">Keterangan</label>
                                        <div>
                                            <textarea class="summernote-simple" id="keterangan" name="keterangan"></textarea>
                                        </div>
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

    <script src="/backend/plugins/select2/js/select2.full.min.js"></script>
    <script>
        $(function() {
            $(".select2").select2();
        });
    </script>
    <script src="/backend/plugins/selectric/public/jquery.selectric.min.js"></script>
    <script src="/backend/plugins/summernote/dist/summernote-bs4.js"></script>
    <script>
        $(document).ready(function() {
            $('#tgl_timbang').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'YYYY-MM-DD'
                },
                startDate: moment()
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
            // Menggunakan event change untuk mendeteksi perubahan pada dropdown Perkembangan
            $('#perkembangan').change(function() {
                // Mendapatkan nilai dropdown yang dipilih
                var selectedValue = $(this).val();

                // Menampilkan atau menyembunyikan elemen keterangan berdasarkan nilai dropdown
                if (selectedValue === 'T') {
                    $('#keterangan-container').show();
                } else {
                    $('#keterangan-container').hide();
                }
            });
        });

        $(document).ready(function() {
            $('.summernote-simple').summernote({
                height: 200,
            });
        });
    </script>
@endsection
