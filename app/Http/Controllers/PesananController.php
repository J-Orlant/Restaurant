<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Pesanan::all();
        return view('pages.admin.pesanan.index', ['query' => $query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = Menu::all();
        return view('pages.admin.pesanan.insert', compact('menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $item = Menu::findOrFail($data['menu_id']);

        $pesanan = Pesanan::create($data);
        Transaksi::create([
            'pesanan_id' => $pesanan->id,
            'total' => $item->harga * $data['jumlah'],
            'bayar' => 0,
        ]);

        return redirect()->route('pesanan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::all();
        $item = Pesanan::findOrFail($id);
        $namaMenu = Menu::findOrFail($item->menu_id);
        return view('pages.admin.pesanan.edit', compact('menu', 'item', 'namaMenu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $item = Pesanan::findOrFail($id);
        $item->update($data);

        return redirect()->route('pesanan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Pesanan::findOrFail($id);
        $item->delete();

        return redirect()->route('pesanan.index');
    }
}
