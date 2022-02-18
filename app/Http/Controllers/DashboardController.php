<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Transaksi;
use App\Models\User;

class DashboardController extends Controller
{

    public function index()
    {

        $menu = Menu::count();
        $user = User::count();
        $transaksi = Transaksi::count();
        $pesanan = Pesanan::count();

        $data = Pesanan::with('menu')->where('status', 'DIANTAR')->get(['menu_id','jumlah']);
        // $data = Menu::findMany($id);
        $total = 0;
        if($data) {
            foreach ($data as $d) {
                $total += $d->menu->harga * $d->jumlah;
            }
        }
        // dd($total);

        return view('pages.admin.index',compact('menu', 'user', 'transaksi', 'pesanan', 'data', 'total'));
    }

}
