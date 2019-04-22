@extends('layout.user')

@section('title')
    Edit Anggota
@endsection

@section('current-page')
    Anggota
@endsection

@section('content')
    <div class="form-wrapper">
        <div class="form-header">
            <h3 class="form-header-text">Edit Anggota</h3>
        </div>
        <form action="/master/anggota/{{ $anggota->id }}" method="POST" autocomplete="off" id="edit-anggota">
            @csrf
            @method("PUT")

            <div class="form-body">
                <div class="form-control">
                    <div class="form-label">
                        <label for="nama">Nama</label>
                    </div>

                    <input type="text" id="nama" class="input" name="nama" placeholder="Masukkan Nama Anggota" value="{{ $anggota->nama }}" />
                </div>

                <div class="form-control">
                    <div class="form-label">
                        <label for="alamat">Alamat</label>
                    </div>

                    <textarea id="alamat" class="textarea" name="alamat" placeholder="Masukkan Alamat Anggota" rows="3">{{ $anggota->alamat }}</textarea>
                </div>

                <div class="form-control">
                    <div class="form-label">
                        <label for="telepon">No. Telepon</label>
                    </div>

                    <input type="text" id="telepon" class="input" name="telepon" placeholder="Masukkan No. Telepon Anggota" value="{{ $anggota->telepon }}" />
                </div>

                <div class="form-control">
                    <div class="form-label">
                        <label for="noktp">No. KTP</label>
                    </div>

                    <input type="text" id="noktp" class="input" name="noktp" placeholder="Masukkan No. KTP Anggota" value="{{ $anggota->noktp }}" />
                </div>

                <div class="form-control">
                    <div class="form-label">
                        <label>Jenis Kelamin</label>
                    </div>

                    <select id="jenis-kelamin" name="kelamin_id" class="input">
                        <option value="">None</option>
                        <option value="1" {{ $anggota->kelamin_id == 1 ? "selected" : ""}}>Laki-laki</option>
                        <option value="2" {{ $anggota->kelamin_id == 2 ? "selected" : ""}}>Perempuan</option>
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