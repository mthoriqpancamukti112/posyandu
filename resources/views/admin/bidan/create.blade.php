@extends('layout.be.template')
@section('title', 'Tambah Data Bidan')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('bidan.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nik" class="form-label">NIK</label>
                                        <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                            id="nik" name="nik" value="{{ old('nik') }}">
                                        @error('nik')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="nip" class="form-label">NIP</label>
                                        <input type="text" class="form-control @error('nip') is-invalid @enderror"
                                            id="nip" name="nip" value="{{ old('nip') }}">
                                        @error('nip')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_bidan" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control @error('nama_bidan') is-invalid @enderror"
                                            id="nama_bidan" name="nama_bidan" value="{{ old('nama_bidan') }}">
                                        @error('nama_bidan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="username" class="form-label">Nama Panggilan</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                                            id="username" name="username" value="{{ old('username') }}">
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror"
                                            id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir') }}">
                                        @error('tgl_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class=col-md-6>
                                    <div class="form-group">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                            id="alamat" name="alamat" value="{{ old('alamat') }}">
                                        @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="no_hp" class="form-label">No HP</label>
                                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                            id="no_hp" name="no_hp" value="{{ old('no_hp') }}">
                                        @error('no_hp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password" value="{{ old('password') }}">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                    <a href="{{ route('bidan.index') }}" class="btn btn-danger btn-sm">Batal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
