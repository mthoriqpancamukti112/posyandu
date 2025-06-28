@extends('layout.be.template')
@section('title', 'Tambah Data Jadwal Kegiatan')
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
                        <form id="add-schedule-form" action="{{ route('jadwal.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="form-label">Judul Kegiatan</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            id="title" name="title" value="{{ old('title') }}">
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="message" class="form-label">Pesan Singkat</label>
                                        <input type="text" class="form-control @error('message') is-invalid @enderror"
                                            id="message" name="message" value="{{ old('message') }}">
                                        @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="start" class="form-label">Tanggal</label>
                                        <input id="start" type="text" class="form-control datepicker" name="start"
                                            value="{{ old('start') }}">
                                        @error('start')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lokasi" class="form-label">Lokasi</label>
                                        <input type="text" class="form-control @error('lokasi') is-invalid @enderror"
                                            id="lokasi" name="lokasi" value="{{ old('lokasi') }}">
                                        @error('lokasi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <input type="text" class="form-control" id="keterangan" name="keterangan"
                                            value="{{ old('keterangan') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="color">Warna</label>
                                        <input type="color" name="color" id="color" class="form-control"
                                            value="#000000">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm"
                                        onclick="handleAddSchedule()">Simpan</button>
                                    <a href="{{ route('jadwal.index') }}" class="btn btn-danger btn-sm">Batal</a>
                                </div>
                            </div>
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
            $('#start').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'YYYY-MM-DD'
                },
                startDate: moment()
            });
        });
    </script>
@endsection
