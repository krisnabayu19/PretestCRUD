@extends('layout.user')

@section('title')
    Edit User
@endsection

@section('current-page')
    User
@endsection

@section('content')
    <div class="form-wrapper">
        <div class="form-header">
            <h3 class="form-header-text">Edit User</h3>
        </div>
        <form action="/master/user/{{ $current_user->id }}" method="POST" autocomplete="off" id="edit-user">
            @csrf
            @method("PUT")

            <div class="form-body">
                <div class="form-control">
                    <div class="form-label">
                        <label for="nik">NIK</label>
                    </div>

                    <input type="text" id="nik" class="input" name="nik" placeholder="Masukkan NIK User" value="{{ $current_user->nik }}" />
                </div>

                <div class="form-control">
                    <div class="form-label">
                        <label for="nama">Nama</label>
                    </div>

                    <input type="text" id="nama" class="input" name="nama" placeholder="Masukkan Nama User" value="{{ $current_user->nama }}" />
                </div>

                <div class="form-control">
                    <div class="form-label">
                        <label>Role</label>
                    </div>

                    <select id="role" name="role" class="input">
                        <option value="">None</option>
                        <option value="1" {{ $current_user->user_role == 1 ? "selected" : ""}}>Pengelola Simpanan</option>
                        <option value="2" {{ $current_user->user_role == 2 ? "selected" : ""}}>Pengelola Pinjaman</option>
                        <option value="3" {{ $current_user->user_role == 3 ? "selected" : ""}}>Admin</option>
                    </select>
                </div>
            </div>

            <div class="form-footer">
                <button type="submit" name="submit" class="button">Submit</button>
            </div>
        </form>
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
@endsection