@extends('layout.user')

@section('title')
    Daftar User
@endsection

@section('current-page')
    User
@endsection

@section('content')
    <div class="table-wrapper">
        <div class="table-header">
            <h4 class="table-header-text">Daftar User</h4>
            <form action="/master/user/create" method="GET">
                <button type="submit" class="btn-create"><i class="fa fa-plus"></i>Tambah User</button>
            </form>
        </div>
        <div class="table-body">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Role</th>
                        <th>Status Aktif</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < count($users); $i++)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $users[$i]->nik }}</td>
                            <td>{{ $users[$i]->nama }}</td>
                            <td>
                                @if ($users[$i]->user_role == 1)
                                    Pengelola Simpanan
                                @elseif ($users[$i]->user_role == 2)
                                    Pengelola Pinjaman
                                @elseif ($users[$i]->user_role == 3)
                                    Admin
                                @endif
                            </td>
                            <td>{{ $users[$i]->status_aktif == 1 ? "Aktif" : "Nonaktif" }}</td>
                            <td>
                                @if ($users[$i]->status_aktif == 1)
                                    <button class="btn-more">
                                        <div class="small-bullet"></div>
                                        <div class="small-bullet"></div>
                                        <div class="small-bullet"></div>
                                    </button>
                                    <div class="menu">
                                        <ul>
                                            <form action="/master/user/{{ $users[$i]->id }}" method="GET">
                                                <button class="btn-menu-list" type="submit">View</button>
                                            </form>
                                            <form action="/master/user/{{ $users[$i]->id }}/edit" method="GET">
                                                <button class="btn-menu-list" type="submit">Edit</button>
                                            </form>
                                            <form action="/master/user/{{ $users[$i]->id }}" method="POST">
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