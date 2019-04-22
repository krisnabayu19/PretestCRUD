@extends('layout.user')

@section('title')
    Dashboard
@endsection

@section('current-page')
    Dashboard
@endsection

@section('content')
    <div class="counter-wrapper">
        <div class="counter-grid">
            <div class="counter bg-pink">
                <div class="counter-header">
                    <div class="space"></div>
                    <h4 class="header-icon"><i class="fa fa-users"></i></h4>
                </div>
                <div class="counter-body">
                    <h3 class="counter-value">{{ $totalAnggota }}</h3>
                </div>
                <div class="counter-footer">
                    <h4 class="counter-info">Total Anggota</h4>
                </div>
            </div>
        </div>
        <div class="counter-grid">
            <div class="counter bg-red">
                <div class="counter-header">
                    <div class="space"></div>
                    <h4 class="header-icon"><i class="fa fa-credit-card"></i></h4>
                </div>
                <div class="counter-body">
                <h3 class="counter-value">{{ format_rupiah($totalSimpanan) }}</h3>
                </div>
                <div class="counter-footer">
                    <h4 class="counter-info">Simpanan Bulan Ini</h4>
                </div>
            </div>
        </div>
        <div class="counter-grid">
            <div class="counter bg-blue">
                <div class="counter-header">
                    <div class="space"></div>
                    <h4 class="header-icon"><i class="fa fa-percent"></i></h4>
                </div>
                <div class="counter-body">
                    <h3 class="counter-value">{{ $bungaSimpanan ? $bungaSimpanan->persentase : 0}}%</h3>
                </div>
                <div class="counter-footer">
                    <h4 class="counter-info">Bunga Simpanan</h4>
                </div>
            </div>
        </div>
        <div class="counter-grid">
            <div class="counter bg-blue">
                <div class="counter-header">
                    <div class="space"></div>
                    <h4 class="header-icon"><i class="fa fa-percent"></i></h4>
                </div>
                <div class="counter-body">
                    <h3 class="counter-value">1024</h3>
                </div>
                <div class="counter-footer">
                    <h4 class="counter-info">Bunga Pinjaman</h4>
                </div>
            </div>
        </div>
        <div class="counter-grid">
            <div class="counter bg-green">
                <div class="counter-header">
                    <div class="space"></div>
                    <h4 class="header-icon"><i class="fa fa-handshake-o"></i></h4>
                </div>
                <div class="counter-body">
                    <h3 class="counter-value">1024</h3>
                </div>
                <div class="counter-footer">
                    <h4 class="counter-info">Total Pinjaman</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="chart-wrapper">
        <canvas id="simpanan"></canvas>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script>
        var ctx = document.getElementById('simpanan').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
                datasets: [{
                    label: "Total Simpanan",
                    backgroundColor: '#1976d2',
                    borderColor: '#1976d2',
                    data: {!! json_encode($simpanan) !!},
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
@endsection
