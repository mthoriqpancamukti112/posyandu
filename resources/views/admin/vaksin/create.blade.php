@extends('layout.be.template')
@section('title', 'Tambah Data Vaksin')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('vaksin.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="jenis_vaksin" class="form-label">Jenis Vaksin</label>
                                <input type="text" class="form-control @error('jenis_vaksin') is-invalid @enderror"
                                    id="jenis_vaksin" name="jenis_vaksin" value="{{ old('jenis_vaksin') }}">
                                @error('jenis_vaksin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="stok" class="form-label">Stok</label>
                                <input type="text" class="form-control @error('stok') is-invalid @enderror"
                                    id="stok" name="stok" value="{{ old('stok') }}">
                                @error('stok')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            <a href="{{ route('vaksin.index') }}" class="btn btn-danger btn-sm">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
