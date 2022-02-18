<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {

        $menu = Menu::count();
        $user = User::count();
        $transaksi = Transaksi::count();
        $pesanan = Pesanan::count();

        // if($date == null) {
        //     $object = Carbon::now();
        //     $date = $object->toDateString();
        //     $data = Pesanan::with('menu')->where('status', 'DIANTAR')->whereRaw('DATE(created_at) = ?', [$date])->get(['menu_id','jumlah']);
        // }
        // dd(request()->d);
        if(request()->has('d')) {
            $data = Pesanan::with('menu')->where('status', 'DIANTAR')->whereRaw('DATE(created_at) = ?', [request()->d])->get(['menu_id','jumlah']);
        } else {
            $object = Carbon::now();
            $date = $object->toDateString();
            $data = Pesanan::with('menu')->where('status', 'DIANTAR')->whereRaw('DATE(created_at) = ?', [$date])->get(['menu_id','jumlah']);
        }

        // $data = Menu::findMany($id);
        $total = 0;
        if($data) {
            foreach ($data as $d) {
                $total += $d->menu->harga * $d->jumlah;
            }
        }

        return view('pages.admin.index',compact('menu', 'user', 'transaksi', 'pesanan', 'data', 'total'));
    }

    public function laporan(Request $request)
    {
        $item = $request->all();

        $waktu = $item['waktu'];

        // dd($waktu);

        return redirect()->route('dashboard', ['d' => $waktu]);
    }

}
