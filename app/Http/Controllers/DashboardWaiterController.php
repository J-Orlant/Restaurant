<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardWaiterController extends Controller
{

    public function index()
    {
        $pesanan = Pesanan::where('status', 'DIBUAT')->orderBy('id', 'DESC')->paginate(5);

        return view('pages.waiter.index',compact('pesanan'));
    }

    public function pesanan($id) {
        $item = Pesanan::findOrFail($id);

        if($item) {
            $item->status = 'DIANTAR';
            $item->save();
        }

        return redirect()->route('dashboardWaiter');
    }

    public function order() {

        $menu = Menu::all();

        return view('pages.waiter.order', compact('menu'));
    }

    public function orderAction(Request $request) {
        // dd($request->all());

        $data = $request->all();
        $itemMenu = Menu::findOrFail($data['menu_id']);

        $pesanan = Pesanan::create($data);
        Transaksi::create([
            'pesanan_id' => $pesanan->id,
            'total' => $itemMenu->harga * $data['jumlah'],
            'bayar' => 0,
        ]);

        return redirect()->route('waiter-order')->with('success', 'Menu berhasil dipesan');
    }

}
