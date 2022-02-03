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

        return view('pages.admin.index',compact('menu', 'user', 'transaksi', 'pesanan'));
    }

}
