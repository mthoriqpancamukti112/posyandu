@extends('layout.be.template')
@section('title', 'Data Vaksin')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('vaksin.create') }}" class="btn btn-success btn-sm btn-block card-title">Tambah
                            Data</a>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Vaksin</th>
                                    <th>Jumlah Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vaksin as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->jenis_vaksin }}</td>
                                        <td>{{ $row->stok }}</td>
                                        <td>
                                            <a href="{{ route('vaksin.edit', $row->id) }}" class="btn btn-warning btn-sm"><i
                                                    class="fas fa-pencil-alt"></i></a>
                                            <form action="{{ route('vaksin.destroy', $row->id) }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="fas fa-trash nav-icon"></i></button>
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
