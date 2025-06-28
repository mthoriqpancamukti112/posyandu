@extends('layout.be.template')
@section('title', 'Data Penimbangan Anak')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Anak</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Nama Orang Tua</th>
                                    <th>Tanggal Penimbangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penimbangan as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->balitas->nama_anak }}</td>
                                        <td>{{ \Carbon\Carbon::parse($row->balitas->tgl_lahir)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                                        </td>
                                        <td>{{ $row->balitas->orangtuas->nama_ortu }}</td>
                                        <td>{{ \Carbon\Carbon::parse($row->tgl_timbang)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                                        </td>
                                        <td>
                                            <form action="{{ route('penimbangan.destroy', $row->id) }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    Batal
                                                </button>
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
                                                    <h5 class="modal-title" id="detailModalLabel">Detail Penimbangan
                                                        Anak</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Nama Anak:</strong> {{ $row->balitas->nama_anak }}</p>
                                                    <p><strong>Jenis Kelamin:</strong>
                                                        @if ($row->balitas->jenis_kelamin == 'L')
                                                            Laki-laki
                                                        @else
                                                            Perempuan
                                                        @endif
                                                    </p>
                                                    <p><strong>Tanggal Lahir:</strong>
                                                        {{ \Carbon\Carbon::parse($row->tgl_lahir)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                                                    </p>
                                                    <p><strong>Nama Orang Tua:</strong>
                                                        {{ $row->balitas->orangtuas->nama_ortu }}</p>
                                                    <p><strong>Tanggal Penimbangan:</strong>
                                                        {{ \Carbon\Carbon::parse($row->tgl_timbang)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                                                    </p>
                                                    <p><strong>Berat Badan:</strong> {{ $row->berat_badan }}</p>
                                                    <p><strong>Tinggi Badan:</strong> {{ $row->tinggi_badan }}</p>
                                                    <p><strong>Perkembangan:</strong>
                                                        @if ($row->perkembangan == 'Y')
                                                            Sesuai
                                                        @else
                                                            Tidak Sesuai
                                                        @endif
                                                    </p>
                                                    <p><strong>Keterangan:</strong>
                                                        @if ($row->keterangan == null)
                                                            Tidak Ada Keterangan
                                                        @else
                                                            {{ strip_tags($row->keterangan) }}
                                                        @endif
                                                    </p>
                                                    <div class="d-flex">
                                                        <p><strong>Dilakukan Oleh:</strong></p>
                                                        <div style="padding-left: 10px">
                                                            @if ($row->users)
                                                                {{ $row->users->username ?? 'Tidak Di Ketahui' }}
                                                            @else
                                                                @if ($row->bidans)
                                                                    {{ $row->bidans->nama_bidan ?? 'Tidak Di Ketahui' }}
                                                                @endif
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
