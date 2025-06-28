@extends('layout.be.template')
@section('title', 'Edit Data Orang Tua')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('orangtua.update', $orangtua->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nik" class="form-label">NIK</label>
                                    <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                        id="nik" name="nik" value="{{ $orangtua->nik }}">
                                    @error('nik')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nama_ortu" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('nama_ortu') is-invalid @enderror"
                                        id="nama_ortu" name="nama_ortu" value="{{ $orangtua->nama_ortu }}">
                                    @error('nama_ortu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="username" class="form-label">Nama Panggilan</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        id="username" name="username"
                                        value="{{ old('username', $orangtua->user->username) }}">
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror"
                                        id="tgl_lahir" name="tgl_lahir" value="{{ $orangtua->tgl_lahir }}">
                                    @error('tgl_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_hp" class="form-label">No HP</label>
                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                        id="no_hp" name="no_hp" value="{{ $orangtua->no_hp }}">
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email', $orangtua->user->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                <a href="{{ route('orangtua.index') }}" class="btn btn-danger btn-sm">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
