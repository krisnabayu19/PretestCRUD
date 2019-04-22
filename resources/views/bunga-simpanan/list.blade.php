@extends('layout.user')

@section('title')
    Daftar Bunga Simpanan
@endsection

@section('current-page')
    Bunga Simpanan
@endsection

@section('content')
    <div class="table-wrapper">
        <div class="table-header">
            <h4 class="table-header-text">Daftar Bunga Simpanan</h4>
            <form action="/master/bunga-simpanan/create" method="GET">
                <button type="submit" class="btn-create"><i class="fa fa-plus"></i>Tambah Bunga Simpanan</button>
            </form>
        </div>
        <table class="table" id="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Persentase Bunga</th>
                    <th>Tanggal Berlaku</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < count($bungas); $i++)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $bungas[$i]->persentase }}%</td>
                        <td>{{ $bungas[$i]->tanggal_mulai_berlaku }}</td>
                        <td>
                            @php
                                $tanggal_mulai_berlaku = date_create($bungas[$i]->tanggal_mulai_berlaku);
                                $tanggal_sekarang = date_create("now");
                                $perbedaan_tanggal = date_diff($tanggal_sekarang, $tanggal_mulai_berlaku);
                            @endphp
                            @if ($perbedaan_tanggal->format("%R") == "+")
                                <button class="btn-more">
                                    <div class="small-bullet"></div>
                                    <div class="small-bullet"></div>
                                    <div class="small-bullet"></div>
                                </button>
                                <div class="menu">
                                    <ul>
                                        <form action="/master/bunga-simpanan/{{ $bungas[$i]->id }}/edit" method="GET">
                                            <button class="btn-menu-list" type="submit">Edit</button>
                                        </form>
                                        <form action="/master/bunga-simpanan/{{ $bungas[$i]->id }}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <button class="btn-menu-list" type="submit">Delete</button>
                                        </form>
                                    </ul>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
            $('.notification.visible').animate({
                bottom: "24px"
            }, function() {
                window.setTimeout(function(){
                    $('.notification.visible').animate({
                        bottom: "-75px"
                    });
                }, 3000);
            });
        });
    </script>
    
    <script>
        var show = false;
        var menu = "";

        $(document).click(function(){
            if(show){
                menu.fadeOut(0, function(){
                    show = false;
                    menu = "";
                });
            }
        });
        
        $('.btn-more').click(function(){
            if(!show){
                menu = $(this).siblings('.menu');
                menu.fadeIn("fast", function(){
                    show = true;
                });
            }    
        });
    </script>
@endsection