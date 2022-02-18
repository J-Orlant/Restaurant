<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Array_;

use function PHPUnit\Framework\isEmpty;

class DashboardWaiterController extends Controller
{

    public function index()
    {
        $pesanan = Pesanan::with('transaksi')->groupBy('transaksi_id')->where('status', 'DIBUAT')->orderBy('id', 'DESC')->paginate(5);
        // dd($pesanan);
        // $pesanan = Pesanan::groupBy('nama')->having('menu_id', '>', 1)->get();

        return view('pages.waiter.index',compact('pesanan'));
    }

    public function detail($nama, $meja) {
        $item = Transaksi::where('nama', $nama)->first();
        $pesanan = Pesanan::with('transaksi')->where('transaksi_id', $item->id)->get();

        return view('pages.waiter.detail', compact('pesanan', 'item'));
    }

    public function pesananConfirm($nama) {
        $item = Transaksi::where('nama', $nama)->first();

        $pesanan = Pesanan::where('transaksi_id', $item->id)->get();

        if($pesanan) {
            foreach($pesanan as $p) {
                $p->status = 'DIANTAR';
                $p->save();
            }
        }

        return redirect()->route('dashboardWaiter');
    }

    public function order() {

        $meja = Meja::all();

        return view('pages.waiter.order', compact('meja'));
    }

    public function orderAction(Request $request) {
        // dd($request->all());

        session()->put([
            'nama' => $request['nama'],
            'meja' => $request['meja'],
        ]);

        return redirect()->route('waiter-order-menu', $request['nama']);
    }

    public function menu($nama) {
        $menu = Menu::all();
        $cart = session('cart');

        // dd($cart);

        return view('pages.waiter.orderMenu', compact('menu', 'cart'));
    }

    public function menuAction(Request $request, $id) {
        $menu = Menu::findOrFail($id);

        if(!$menu) {
            abort(404);
        }

        $cart = session('cart');

        $cart[$id] = [
            'gambar' => $menu->gambar,
            'nama_menu' => $menu->nama_menu,
            'harga' => $menu->harga,
            'jumlah' => $request['jumlah'],
        ];

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Menu berhasil dipesan');
    }

    public function cartInsert() {
        $nama = session('nama');
        $meja = session('meja');
        $carts = session('cart');
        $total = 0;

        // dd($carts);

        $transaksi = Transaksi::create([
            'nama' => $nama,
            'meja' => $meja,
            'total' => 0,
            'bayar' => 0,
        ]);

        foreach($carts as $id => $cart) {
            Pesanan::create([
                'menu_id' => $id,
                'transaksi_id' => $transaksi->id,
                'jumlah' => $cart['jumlah'],
                'total' => $cart['jumlah'] * $cart['harga'],
            ]);
            $total += $cart['jumlah'] * $cart['harga'];
        }

        $item = Transaksi::findOrFail($transaksi->id);
        $item->total = $total;
        $item->save();

        $meja = Meja::findOrFail($meja);
        $meja->status = 1;
        $meja->save();

        session()->forget(['nama', 'meja', 'cart']);

        return redirect()->route('dashboardWaiter')->with('success', 'Pesanan baru telah masuk!');
    }

    public function cartDelete($id) {

        $cart = session('cart');
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        if($cart == []) {
            session()->forget('cart');
        }

        return redirect()->route('waiter-order-menu', session('nama'));
    }

    public function cartBatal() {
        if(session()->has('cart')) {
            session()->forget('cart');
        }

        return redirect()->route('waiter-order-menu', session('nama'));
    }
}
