@extends('layout.be.template')
@section('title', 'Data Orang Tua')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('orangtua.create') }}" class="btn btn-success btn-sm btn-block card-title">Tambah
                            Data</a>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama Orang Tua</th>
                                    <th>Nama Anak</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orangtua as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->nik }}</td>
                                        <td>{{ $row->nama_ortu }}</td>
                                        <td>
                                            @if ($row->balitas->isEmpty())
                                                <p>Belum terdaftar</p>
                                            @else
                                                @foreach ($row->balitas as $balita)
                                                    <p>Anak {{ $loop->iteration }}: {{ $balita->nama_anak }}</p>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('orangtua.edit', $row->id) }}"
                                                class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                            <form action="{{ route('orangtua.destroy', $row->id) }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="fas fa-trash nav-icon"></i></button>
                                            </form>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#detailModal{{ $row->id }}">
                                                <i class="fas fa-eye nav-icon"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="detailModal{{ $row->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="detailModalLabel">Detail Orang Tua</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>NIK:</strong> {{ $row->nik }}</p>
                                                    <p><strong>Nama Orang Tua:</strong> {{ $row->nama_ortu }}</p>
                                                    <p><strong>Nama Panggilan:</strong>
                                                        {{ $row->user ? $row->user->username : 'Username not found' }}
                                                    </p>
                                                    </p>
                                                    <p><strong>Tanggal Lahir:</strong>
                                                        {{ \Carbon\Carbon::parse($row->tgl_lahir)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                                                    </p>
                                                    <p><strong>No HP:</strong> {{ $row->no_hp }}</p>
                                                    <p><strong>Email:</strong>
                                                        {{ $row->user ? $row->user->email : 'Email not found' }}</p>
                                                    <div class="d-flex">
                                                        <strong>Nama Anak: </strong>
                                                        <div style="padding-left: 10px">
                                                            @if ($row->balitas->isEmpty())
                                                                <p>Belum Daftar</p>
                                                            @else
                                                                @foreach ($row->balitas as $balita)
                                                                    <p>Anak {{ $loop->iteration }}:
                                                                        {{ $balita->nama_anak }}</p>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
