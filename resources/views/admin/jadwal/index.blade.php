@extends('layout.be.template')
@section('title', 'Jadwal Kegiatan')
@section('styles')
    <link rel="stylesheet" href="/backend/plugins/full-calender/main.min.css">
@endsection
@section('content')
    <section class="content">
        <div class="row">
            @if (auth()->check() && auth()->user()->role != 'ortu')
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('jadwal.create') }}" class="btn btn-success btn-sm btn-block card-title">Tambah
                                Data</a>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Tanggal</th>
                                        <th>Lokasi</th>
                                        <th>Warna Kegiatan</th>
                                        <th>Dibuat Oleh</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwal as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->title }}</td>
                                            <td>{{ \Carbon\Carbon::parse($row->start)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                                            <td>{{ $row->lokasi }}</td>
                                            <td>
                                                <div
                                                    style="width: 20px; height: 20px; background-color: {{ $row->color }};">
                                                </div>
                                            </td>
                                            <td>
                                                @if ($row->users)
                                                    {{ $row->users->username ?? 'Tidak Di Ketahui' }}
                                                @else
                                                    @if ($row->bidans)
                                                        {{ $row->bidans->nama_bidan ?? 'Tidak Di Ketahui' }}
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('jadwal.edit', $row->id) }}"
                                                        class="btn btn-warning btn-sm mr-1"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                    <form action="{{ route('jadwal.destroy', $row->id) }}" method="POST"
                                                        style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                            <i class="fas fa-trash nav-icon"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="/backend/plugins/full-calender/main.min.js"></script>
    <script src="/backend/plugins/full-calender/locales-all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id',
                events: [
                    @foreach ($data as $row)
                        {
                            title: '{{ $row->title }}',
                            start: '{{ $row->start }}',
                            description: '{{ $row->message }}',
                            location: '{{ $row->lokasi }}',
                            extendedProps: {
                                keterangan: '{{ $row->keterangan }}',
                                color: '{{ $row->color }}'
                            }
                        },
                    @endforeach
                ],
                // eventClick: function(info) {
                //     alert('Event: ' + info.event.title + '\nDescription: ' + info.event.extendedProps
                //         .description + '\nLocation: ' + info.event.extendedProps.location +
                //         '\nKeterangan: ' + info.event.extendedProps.keterangan);
                // },
                eventDidMount: function(info) {
                    // Atur warna latar belakang untuk event
                    if (info.event.extendedProps.color) {
                        info.el.style.backgroundColor = info.event.extendedProps.color;
                    }
                },
            });

            calendar.render();
        });
    </script>
@endsection
