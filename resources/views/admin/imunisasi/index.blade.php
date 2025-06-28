@extends('layout.be.template')
@section('title', 'Data Imunisasi Anak')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3>Rekapitulasi Vaksin Anak</h3>
                        <table id="rekapVaksin" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Tanggal Imunisasi</th>
                                    <th>Jenis Vaksin</th>
                                    <th>Jumlah Anak</th>
                                    <th>Nama Anak</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rekap_vaksin as $vaksin)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($vaksin->tanggal)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                                        </td>
                                        <td>{{ $vaksin->jenis_vaksin }}</td>
                                        <td>{{ $vaksin->jumlah_balita }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#lihatBalitaModal{{ $vaksin->vaksin_id }}-{{ \Carbon\Carbon::parse($vaksin->tanggal)->format('Ymd') }}">
                                                Lihat
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade"
                                                id="lihatBalitaModal{{ $vaksin->vaksin_id }}-{{ \Carbon\Carbon::parse($vaksin->tanggal)->format('Ymd') }}"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="lihatBalitaModalLabel{{ $vaksin->vaksin_id }}-{{ \Carbon\Carbon::parse($vaksin->tanggal)->format('Ymd') }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="lihatBalitaModalLabel{{ $vaksin->vaksin_id }}-{{ \Carbon\Carbon::parse($vaksin->tanggal)->format('Ymd') }}">
                                                                Nama Anak untuk Vaksin {{ $vaksin->jenis_vaksin }} pada
                                                                Tanggal
                                                                {{ \Carbon\Carbon::parse($vaksin->tanggal)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @php
                                                                // Ambil data nama anak yang relevan
                                                                $filteredBalitas = $rekap_vaksin->firstWhere(function (
                                                                    $item,
                                                                ) use ($vaksin) {
                                                                    return $item->vaksin_id == $vaksin->vaksin_id &&
                                                                        $item->tanggal == $vaksin->tanggal;
                                                                });
                                                            @endphp

                                                            @if ($filteredBalitas && !empty($filteredBalitas->nama_balita))
                                                                <ol>
                                                                    @foreach ($filteredBalitas->nama_balita as $nama_balita)
                                                                        <li>{{ $nama_balita }}</li>
                                                                    @endforeach
                                                                </ol>
                                                            @else
                                                                <p>Tidak ada data anak untuk vaksin ini pada tanggal ini.
                                                                </p>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Tutup</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <h3>Data Imunisasi Anak</h3>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Anak</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Nama Orang Tua</th>
                                    <th>Tanggal Imunisasi</th>
                                    <th>Jenis Vaksin</th>
                                    <th>Kondisi</th>
                                    <th>Dilakukan Oleh</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($imunisasi as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->balitas->nama_anak }}</td>
                                        <td>
                                            @if ($row->balitas->jenis_kelamin == 'L')
                                                Laki-laki
                                            @else
                                                Perempuan
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($row->balitas->tgl_lahir)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                                        </td>
                                        <td>{{ $row->balitas->orangtuas->nama_ortu }}</td>
                                        <td>{{ \Carbon\Carbon::parse($row->tanggal)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                                        </td>
                                        <td>
                                            @if ($row->vaksin_id == null)
                                                Belum Dilakukan Imunisasi
                                            @else
                                                {{ $row->vaksins->jenis_vaksin }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($row->kondisi == 'T')
                                                Tidak Bisa Di Vaksin
                                            @else
                                                Sudah Melakukan Vaksin
                                            @endif
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
                                            <form action="{{ route('imunisasi.destroy', $row->id) }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    Batal
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
