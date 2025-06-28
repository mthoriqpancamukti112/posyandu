@extends('layout.be.template')
@section('title', 'Update Data Jadwal Kegiatan')
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
                        <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="title" class="form-label">title Kegiatan</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" value="{{ $jadwal->title }}">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="message" class="form-label">Pesan</label>
                                <input type="text" class="form-control @error('message') is-invalid @enderror"
                                    id="message" name="message" value="{{ $jadwal->message }}">
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="start" class="form-label">Tanggal</label>
                                <input id="start" type="text" class="form-control datepicker" name="start"
                                    value="{{ $jadwal->start }}">
                                @error('start')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="lokasi" class="form-label">Lokasi</label>
                                <input type="text" class="form-control @error('lokasi') is-invalid @enderror"
                                    id="lokasi" name="lokasi" value="{{ $jadwal->lokasi }}">
                                @error('lokasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                    id="keterangan" name="keterangan" value="{{ $jadwal->keterangan }}">
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="color">Warna</label>
                                <input type="color" name="color" id="color" class="form-control"
                                    value="{{ $jadwal->color }}">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            <a href="{{ route('jadwal.index') }}" class="btn btn-danger btn-sm">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <!-- Date Range Picker JS -->
    <script src="/backend/plugins/bootstrap-daterangepicker/moment.min.js"></script>
    <script src="/backend/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

    <script src="/backend/plugins/selectric/public/jquery.selectric.min.js"></script>
    <script>
        $(document).ready(function() {
            var startDate = moment("{{ $jadwal->start }}", "YYYY-MM-DD").format("YYYY-MM-DD");

            $('#start').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'YYYY-MM-DD'
                },
                startDate: moment("{{ $jadwal->start }}", "YYYY-MM-DD")
            });
        });
    </script>
@endsection
