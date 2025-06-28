@extends('layout.be.template')
@section('title', 'Detail Jadwal Kegiatan')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-center align-items-center text-center">
                <div class="col-md-6 mb-2">
                    <img src="/img/notifikasi.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <h5 class="text-bold">Kegiatan</h5>
                        <p>{{ $jadwal->title }}</p>
                    </div>
                    <div class="form-group">
                        <h5 class="text-bold">Tanggal Kegiatan</h5>
                        <p>{{ \Carbon\Carbon::parse($jadwal->start)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                        </p>
                    </div>
                    <div class="form-group">
                        <h5 class="text-bold">Lokasi Kegiatan</h5>
                        <p>{{ $jadwal->lokasi }}</p>
                    </div>
                    <div class="form-group">
                        <h5 class="text-bold">Deskripsi</h5>
                        <p>{{ $jadwal->keterangan }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
