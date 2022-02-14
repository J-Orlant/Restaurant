<?php

namespace App\Http\Controllers;

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
        $pesanan = Pesanan::where('status', 'DIBUAT')->groupBy('nama')->having('menu_id', '>', 1)->orderBy('id', 'DESC')->paginate(5);
        // $pesanan = Pesanan::groupBy('nama')->having('menu_id', '>', 1)->get();

        return view('pages.waiter.index',compact('pesanan'));
    }

    public function detail($nama, $meja) {
        $pesanan = Pesanan::where('nama', $nama)->get();

        return view('pages.waiter.detail', compact('pesanan', 'nama', 'meja'));
    }

    public function pesananConfirm($nama) {
        $item = Pesanan::where('nama', $nama)->get();

        if($item) {
            foreach($item as $i) {
                $i->status = 'DIANTAR';
                $i->save();
            }
        }

        return redirect()->route('dashboardWaiter');
    }

    public function order() {
        return view('pages.waiter.order');
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

        foreach($carts as $id => $cart) {
            $pesanan = Pesanan::create([
                'menu_id' => $id,
                'nama' => $nama,
                'meja' => $meja,
                'jumlah' => $cart['jumlah'],
            ]);

            Transaksi::create([
                'pesanan_id' => $pesanan->id,
                'total' => $cart['harga'] * $cart['jumlah'],
                'bayar' => 0,
            ]);
        }

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
