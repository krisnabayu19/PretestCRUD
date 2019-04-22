@extends('layout.user')

@section('title')
    Detail User
@endsection

@section('current-page')
    User
@endsection

@section('content')
    <div class="identity">
        <div class="identity-header">
            <h3 class="identity-header-text">Detail User</h3>
        </div>
        <div class="identity-body">
            <div class="identity-data nik">
                <span class="identity-data-label">NIK</span>
                <span class="identity-data-separator">:</span>
                <span class="identity-data-value">{{ $current_user->nik }}</span>
            </div>
            <div class="identity-data nama">
                <span class="identity-data-label">Nama</span>
                <span class="identity-data-separator">:</span>
                <span class="identity-data-value">{{ $current_user->nama }}</span>
            </div>
            <div class="identity-data role">
                <span class="identity-data-label">Role</span>
                <span class="identity-data-separator">:</span>
                <span class="identity-data-value">
                    @if ($current_user->user_role == 1)
                        Pengelola Simpanan
                    @elseif ($current_user->user_role == 2)
                        Pengelola Pinjaman
                    @elseif ($current_user->user_role == 3)
                        Admin
                    @endif
                </span>
            </div>
        </div>
    </div>

    <div class="additional-wrapper">
        <div class="additional-header">
            <h4 class="additional-header-text">Daftar Transaksi Terakhir</h4>
        </div>
        <table class="table" id="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>No Anggota</th>
                    <th>Nominal Transaksi</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < count($transaksi); $i++)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $transaksi[$i]->tanggal }}</td>
                        <td>{{ $no_anggota[$i] }}</td>
                        <td>{{ $transaksi[$i]->nominal_transaksi >= 0 ? format_rupiah($transaksi[$i]->nominal_transaksi) : format_rupiah(substr($transaksi[$i]->nominal_transaksi, 1)) }}</td>
                        <td>
                            @if ($transaksi[$i]->jenis_transaksi == 1)
                                Penyetoran
                            @elseif ($transaksi[$i]->jenis_transaksi == 2)
                                Penarikan
                            @elseif ($transaksi[$i]->jenis_transaksi == 3)
                                Bunga Simpanan
                            @elseif ($transaksi[$i]->jenis_transaksi == 4)
                                Pajak Simpanan
                            @endif
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>

    <div class="detail-footer">
        <form action="/master/user" method="GET">
            <button type="submit" class="btn-create"><i class="fa fa-undo"></i>Kembali</button>
        </form>
    </div>
@endsection