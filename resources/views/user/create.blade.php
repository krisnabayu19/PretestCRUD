@extends('layout.user')

@section('title')
    Tambah User
@endsection

@section('current-page')
    User
@endsection

@section('content')
    <div class="form-wrapper">
        <div class="form-header">
            <h3 class="form-header-text">Tambah User</h3>
        </div>
        <form action="/master/user" method="POST" autocomplete="off" id="tambah-user">
            @csrf

            <div class="form-body">
                <div class="form-control">
                    <div class="form-label">
                        <label for="nik">NIK</label>
                    </div>

                    <input type="text" id="nik" class="input" name="nik" placeholder="Masukkan NIK User" />
                </div>

                <div class="form-control">
                    <div class="form-label">
                        <label for="nama">Nama</label>
                    </div>

                    <input type="text" id="nama" class="input" name="nama" placeholder="Masukkan Nama User" />
                </div>

                <div class="form-control">
                    <div class="form-label">
                        <label for="username">Username</label>
                    </div>

                    <input type="text" id="username" class="input" name="username" placeholder="Masukkan Username" />
                </div>

                <div class="form-control">
                    <div class="form-label">
                        <label for="password">Password</label>
                    </div>

                    <input type="password" id="password" class="input" name="password" placeholder="Masukkan Password" />
                </div>

                <div class="form-control">
                    <div class="form-label">
                        <label for="confirm-password">Confirm Password</label>
                    </div>

                    <input type="password" id="confirm-password" class="input" name="confirm_password" placeholder="Masukkan Confirm Password" />
                </div>

                <div class="form-control">
                    <div class="form-label">
                        <label>Role</label>
                    </div>

                    <select id="role" name="role" class="input">
                        <option value="">None</option>
                        <option value="1">Pengelola Simpanan</option>
                        <option value="2">Pengelola Pinjaman</option>
                        <option value="3">Admin</option>
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