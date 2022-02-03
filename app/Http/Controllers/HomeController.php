<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data =  Menu::all();
        return view('pages.user.index', compact('data'));
    }

    public function pesan($id)
    {
        $menu = Menu::findOrFail($id);

        return view('pages.user.pesan', compact('menu'));
    }

    public function post(Request $request)
    {
        $data = $request->all();
        $item = Menu::findOrFail($data['menu_id']);

        $pesanan = Pesanan::create($data);
        Transaksi::create([
            'pesanan_id' => $pesanan->id,
            'total' => $item->harga * $data['jumlah'],
            'bayar' => 0,
        ]);

        return redirect()->route('home')->with('success', 'Pesanan Berhasil dipesan!');
    }
}
