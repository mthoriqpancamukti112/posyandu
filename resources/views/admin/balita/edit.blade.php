@extends('layout.be.template')
@section('title', 'Edit Data Balita')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('balita.update', $balita->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="nik" class="form-label">NIK</label>
                                    <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                        id="nik" name="nik" value="{{ old('nik', $balita->nik) }}">
                                    @error('nik')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nama_anak" class="form-label">Nama Balita</label>
                                    <input type="text" class="form-control @error('nama_anak') is-invalid @enderror"
                                        id="nama_anak" name="nama_anak" value="{{ old('nama_anak', $balita->nama_anak) }}">
                                    @error('nama_anak')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <select class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                        id="jenis_kelamin" name="jenis_kelamin" style="width: 100%">
                                        <option value="" selected disabled>--Pilih Jenis Kelamin--
                                        </option>
                                        <option value="L"
                                            {{ old('jenis_kelamin', $balita->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                                            Laki-laki</option>
                                        <option value="P"
                                            {{ old('jenis_kelamin', $balita->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">


                                <div class="form-group">
                                    <label for="orangtua_id" class="form-label">Orang Tua</label>
                                    <select class="form-control select2 @error('orangtua_id') is-invalid @enderror"
                                        id="orangtua_id" name="orangtua_id">
                                        <option value="" selected disabled>--Pilih Orang Tua--</option>
                                        @foreach ($orangtuas as $orangtua)
                                            <option value="{{ $orangtua->id }}"
                                                {{ old('orangtua_id', $balita->orangtua_id) == $orangtua->id ? 'selected' : '' }}>
                                                {{ $orangtua->nama_ortu }}</option>
                                        @endforeach
                                    </select>
                                    @error('orangtua_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="text" class="form-control @error('tgl_lahir') is-invalid @enderror"
                                        id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir', $balita->tgl_lahir) }}">
                                    @error('tgl_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                <a href="{{ route('balita.index') }}" class="btn btn-danger btn-sm">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- Select2 -->
    <script src="/backend/plugins/select2/js/select2.full.min.js"></script>
    <!-- Custom Script for Select2 -->
    <script>
        $(function() {
            // Initialize Select2 Elements
            $(".select2").select2();
        });
    </script>
@endsection
