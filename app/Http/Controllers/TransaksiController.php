<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Transaksi::all();

        return view('pages.admin.transaksi.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages.admin.transaksi.detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Transaksi::findOrFail($id);

        $pesanan_id = $item->pesanan_id;
        $pesanan = Pesanan::findOrFail($pesanan_id);

        $menu_id = $pesanan->menu_id;
        $namaMenu = Menu::findOrFail($menu_id);

        $menu = Menu::all();

        // dd($namaMenu);

        return view('pages.admin.transaksi.edit', compact('item', 'menu', 'namaMenu', 'pesanan'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Transaksi::findOrFail($id);

        $item->delete();

        return redirect()->route('transaksi.index');
    }

    public function detail($nama)
    {
        $item = Transaksi::where('nama', $nama)->first();
        $total = $item->total;

        $pesanan = Pesanan::with('menu')->where('transaksi_id', $item->id)->get();
        // dd($pesanan);

        return view('pages.admin.transaksi.detail', compact('pesanan', 'item', 'total'));
    }
}
