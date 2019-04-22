@extends('layout.user')

@section('title')
    Detail Anggota
@endsection

@section('current-page')
    Anggota
@endsection

@section('content')
    <div class="identity">
        <div class="identity-header">
            <h3 class="identity-header-text">Detail Anggota</h3>
        </div>
        <div class="identity-body">
            <div class="identity-data no-anggota">
                <span class="identity-data-label">No. Anggota</span>
                <span class="identity-data-separator">:</span>
                <span class="identity-data-value">{{ $anggota->no_anggota }}</span>
            </div>
            <div class="identity-data no-ktp">
                <span class="identity-data-label">No. KTP</span>
                <span class="identity-data-separator">:</span>
                <span class="identity-data-value">{{ $anggota->noktp }}</span>
            </div>
            <div class="identity-data nama">
                <span class="identity-data-label">Nama</span>
                <span class="identity-data-separator">:</span>
                <span class="identity-data-value">{{ $anggota->nama }}</span>
            </div>
            <div class="identity-data jenis-kelamin">
                <span class="identity-data-label">Jenis Kelamin</span>
                <span class="identity-data-separator">:</span>
                <span class="identity-data-value">{{ $anggota->kelamin_id == 1 ? "Laki-laki" : "Perempuan" }}</span>
            </div>
            <div class="identity-data alamat">
                <span class="identity-data-label">Alamat</span>
                <span class="identity-data-separator">:</span>
                <span class="identity-data-value">{{ $anggota->alamat }}</span>
            </div>
            <div class="identity-data telepon">
                <span class="identity-data-label">Telepon</span>
                <span class="identity-data-separator">:</span>
                <span class="identity-data-value">{{ $anggota->telepon }}</span>
            </div>
        </div>
    </div>

    @yield('additional-content')

@endsection