<?php

namespace App\Http\Controllers;

use App\Anggota;
use App\User;
use App\Simpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $session = Session::all();
        if(isset($session['user'])){
            $user = User::find($session['user']);
            $anggotas = Anggota::get();
            $anggota = array();

            for ($i=0; $i < count($anggotas); $i++) { 
                $id = $anggotas[$i]->id;
                $no_anggota = $anggotas[$i]->no_anggota;
                $nama = $anggotas[$i]->nama;
                $alamat = $anggotas[$i]->alamat;
                $telepon = $anggotas[$i]->telepon;
                $noktp = $anggotas[$i]->noktp;
                $kelamin_id = $anggotas[$i]->kelamin_id;
                $saldo = Simpanan::where("anggota_id", $id)->sum("nominal_transaksi");
                $status_aktif = $anggotas[$i]->status_aktif;

                $object = (object) ["id" => $id, "no_anggota" => $no_anggota, "nama" => $nama, "alamat" => $alamat, "telepon" => $telepon, "noktp" => $noktp, "kelamin_id" => $kelamin_id, "saldo" => $saldo, "status_aktif" => $status_aktif];
                array_push($anggota, $object);
            }

            return view("anggota.list", compact("user", "anggota"));
        } else {
            return redirect("/sign-in");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $session = Session::all();
        if(isset($session['user'])){
            $user = User::find($session['user']);
            return view("anggota.create", compact("user"));
        } else {
            return redirect("/sign-in");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(isset($request->nama) && isset($request->alamat) && isset($request->telepon) && isset($request->noktp) && isset($request->kelamin_id)){
            $jumlah_anggota = Anggota::where("no_anggota", "like", date("Y")."%")->count();
            $no_anggota = sprintf("%s%'.09d", date("Y"), $jumlah_anggota + 1);
            $anggota = new Anggota;
            $anggota->no_anggota = $no_anggota;
            $anggota->nama = $request->nama;
            $anggota->alamat = $request->alamat;
            $anggota->telepon = $request->telepon;
            $anggota->noktp = $request->noktp;
            $anggota->kelamin_id = $request->kelamin_id;
            $anggota->status_aktif = 1;
            $anggota->user_id = Session::get('user');

            $anggota->save();

            return redirect()->action('AnggotaController@index')->with("success", "Berhasil menambahkan anggota");
        } else {
            return redirect()->action('AnggotaController@create')->with("error", "Mohon isikan semua form");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $session = Session::all();
        if(isset($session['user'])){
            $user = User::find($session['user']);
            $anggota = Anggota::find($id);
            $saldo = Simpanan::where("anggota_id", $id)->sum("nominal_transaksi");
            $transaksi = Simpanan::where("anggota_id", $id)->orderBy("id", "DESC")->take(10)->get();
            return view("anggota.view", compact("user", "anggota", "saldo", "transaksi"));
        } else {
            return redirect("/sign-in");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $session = Session::all();
        if(isset($session['user'])){
            $user = User::find($session['user']);
            $anggota = Anggota::find($id);
            return view("anggota.edit", compact("user", 'anggota'));
        } else {
            return redirect("/sign-in");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(isset($request->nama) && isset($request->alamat) && isset($request->telepon) && isset($request->noktp) && isset($request->kelamin_id)){
            $anggota = Anggota::find($id);
            $anggota->nama = $request->nama;
            $anggota->alamat = $request->alamat;
            $anggota->telepon = $request->telepon;
            $anggota->noktp = $request->noktp;
            $anggota->kelamin_id = $request->kelamin_id;
            $anggota->user_id = Session::get('user');

            $anggota->save();

            return redirect()->action('AnggotaController@index')->with("success", "Berhasil mengubah data anggota");
        } else {
            return redirect()->action('AnggotaController@edit', ["id" => $id])->with("error", "Mohon isikan semua form");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $anggota = Anggota::find($id);
        $anggota->status_aktif = 2;

        $anggota->save();
        return redirect()->action('AnggotaController@index')->with("success", "Berhasil menonaktifkan anggota");
    }
}
