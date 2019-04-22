@extends('layout.user')

@section('title')
    Proses Bunga Simpanan
@endsection

@section('current-page')
    Bunga Simpanan
@endsection

@section('content')
    <div class="identity">
        <div class="identity-header">
            <h3 class="identity-header-text">Proses Bunga Simpanan</h3>
        </div>
        <div class="identity-body">
            <div class="identity-data bulan">
                <span class="identity-data-label">Bulan</span>
                <span class="identity-data-separator">:</span>
                <span class="identity-data-value">{{ $detail->bulan }}</span>
            </div>
            <div class="identity-data tahun">
                <span class="identity-data-label">Tahun</span>
                <span class="identity-data-separator">:</span>
                <span class="identity-data-value">{{ $detail->tahun }}</span>
            </div>
            <div class="identity-data persentase">
                <span class="identity-data-label">Persentase Bunga</span>
                <span class="identity-data-separator">:</span>
                <span class="identity-data-value">{{ $detail->persentase_bunga }}%</span>
            </div>
            <div class="identity-data status">
                <span class="identity-data-label">Status</span>
                <span class="identity-data-separator">:</span>
                <span class="identity-data-value">{{ $detail->status == 0 ? "Belum Diproses" : "Sudah Diproses" }}</span>
            </div>
        </div>
    </div>

    <div class="additional-wrapper">
        <div class="additional-header">
            <h4 class="additional-header-text">Daftar Proses Bunga Simpanan</h4>
        </div>
        <table class="table" id="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Tanggal Proses</th>
                    <th>Persentase Bunga</th>
                    <th>User</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < count($transaksi); $i++)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $transaksi[$i]->trx_bulan }}</td>
                        <td>{{ $transaksi[$i]->trx_tahun }}</td>
                        <td>{{ $transaksi[$i]->tanggal_proses }}</td>
                        <td>{{ $transaksi[$i]->persentase_bunga }}</td>
                        <td>{{ $users[$i] }}</td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>

    @if ($detail->status == 0 && date("Y-m-d") == date("Y-m-t"))
        <div class="detail-footer">
            <form action="/transaksi/proses-bunga-simpanan" method="POST">
                @csrf
                <button type="submit" class="btn-create"><i class="fa fa-check"></i>Proses</button>
            </form>
        </div>
    @endif
@endsection