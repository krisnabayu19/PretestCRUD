@extends('layout.detail-anggota')

@section("additional-content")
    <div class="additional-wrapper">
        <div class="additional-header">
            <h4 class="additional-header-text">Daftar Transaksi Terakhir</h4>
        </div>
        <table class="table" id="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Debit</th>
                    <th>Kredit</th>
                    <th>Saldo</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $new_saldo = str_replace(".", "", $saldo);
                @endphp

                @for ($i = 0; $i < count($transaksi); $i++)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $transaksi[$i]->tanggal }}</td>
                        <td>{{ $transaksi[$i]->nominal_transaksi < 0 ? format_rupiah(substr($transaksi[$i]->nominal_transaksi, 1)) : "-" }}</td>
                        <td>{{ $transaksi[$i]->nominal_transaksi > 0 ? format_rupiah($transaksi[$i]->nominal_transaksi) : "-" }}</td>
                        <td>{{ format_rupiah($new_saldo) }}</td>
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

                    @php
                        $new_saldo = $new_saldo - $transaksi[$i]->nominal_transaksi
                    @endphp
                @endfor
            </tbody>
        </table>
    </div>

    <div class="detail-footer">
        <form action="/master/anggota" method="GET">
            <button type="submit" class="btn-create"><i class="fa fa-undo"></i>Kembali</button>
        </form>
    </div>
@endsection