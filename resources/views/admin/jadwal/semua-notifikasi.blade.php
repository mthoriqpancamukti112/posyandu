@extends('layout.be.template')
@section('title', 'Semua Notifikasi')
@section('content')
    @if ($jadwal->isEmpty())
        <div class="justify-content-center align-items-center text-center">
            <img src="/img/notif.jpg" width="300px" height="100%" alt="">
            <p class="text-muted mt-3">Tidak ada notifikasi saat ini.</p>
        </div>
    @else
        @foreach ($jadwal as $item)
            <div class="card">
                <div class="row">
                    <div class="col-12">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h2><i class="fas fa-calendar-day"></i>
                                        {{ \Carbon\Carbon::parse($item->start)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                                    </h2>
                                    <h5 class="card-title mb-4">{{ $item->title }}</h5>
                                    <p class="card-text"><i class="fas fa-map-marker" style="color: red"></i>
                                        {{ $item->lokasi }}</p>
                                    <hr>
                                </div>
                                <img src="/img/bell.jpg" height="100%" width="100px" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection
