<?php

namespace App\Http\Controllers;

use App\User;
use App\Anggota;
use App\Simpanan;
use App\BungaSimpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        $session = Session::all();
        if(!isset($session['user'])){
            return view("user.sign-in");    
        } else {
            return redirect()->action('UserController@home');
        }
    }

    public function login(Request $request)
    {
        if(isset($request->username) && isset($request->password)){
            $user = User::where('username', $request->username)->first();
            if($user) {
                if(Hash::check($request->password, $user->password)){
                    Session::put('user', $user->id);
                    return redirect("/")->with("success", "Sign in berhasil");
                } else {
                    return redirect()->action("UserController@index")->with("error", "Username atau password salah");
                }
            } else {
                return redirect()->action("UserController@index")->with("error", "Username atau password salah");
            }
        } else {
            return redirect()->action("UserController@index")->with("error", "Mohon isikan semua form");
        }
    }

    public function home()
    {
        $session = Session::all();
        if(isset($session['user'])){
            $year = date('Y');
            $month = date('n');
            $user = User::find($session['user']);
            $totalAnggota = Anggota::where("status_aktif", 1)->get()->count();
            $totalSimpanan = Simpanan::whereMonth('tanggal', $month)->sum('nominal_transaksi');
            $bungaSimpanan = BungaSimpanan::whereDate('tanggal_mulai_berlaku', "<=", date("Y-m-d"))->orderBy("tanggal_mulai_berlaku", "DESC")->first();
            $simpanan = array();

            for ($i=1; $i<=12 ; $i++) { 
                $simpananPerBulan = Simpanan::whereMonth('tanggal', $i)->whereYear('tanggal', $year)->sum('nominal_transaksi');
                array_push($simpanan, $simpananPerBulan);
            }

            return view("user.dashboard", compact("user", "totalAnggota", "totalSimpanan", "bungaSimpanan", "simpanan"));
        } else {
            return redirect("/sign-in");
        }
    }

    public function destroy()
    {
        Session::forget('user');
        return redirect("/sign-in")->with("success", "Sign out berhasil");
    }
}
