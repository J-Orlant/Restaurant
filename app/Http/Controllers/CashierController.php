<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Models\Pesanan;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index()
    {

        $transactions = Transaksi::with('pesanan')->where('status', 'TERTUNDA')->orderBy('id', 'DESC')->paginate(5);

        return view('pages.cashier.index', compact('transactions'));
    }


    public function detail($nama)
    {
        $item = Transaksi::where('nama', $nama)->first();
        $total = $item->total;

        $pesanan = Pesanan::with('menu')->where('transaksi_id', $item->id)->get();

        return view('pages.cashier.detail', compact('pesanan', 'item', 'total'));
    }

    public function transaksi(Request $request, $nama)
    {
        $item = Transaksi::where('nama', $nama)->first();
        $data = $request->all();

        if($data['bayar'] - $item->total >= 0) {
            $item->update([
                'bayar' => $data['bayar'],
                'status' => 'LUNAS',
            ]);

            $meja = Meja::where('id', $item->meja)->first();
            $meja->update([
                'status' => 1,
            ]);

            return redirect()->route('cashier.success', $item->nama);
        } else {
            return redirect()->back()->with('failed', 'Transaksi gagal');
        }
    }

    public function success($nama)
    {

        $item = Transaksi::where('nama', $nama)->first();

        $pesanan = Pesanan::with('menu')->where('transaksi_id', $item->id)->get();

        return view('pages.cashier.success', compact('item', 'pesanan'));
    }

    public function cetakTransaksi($nama)
    {

        $item = Transaksi::where('nama', $nama)->first();

        $pesanan = Pesanan::with('menu')->where('transaksi_id', $item->id)->get();

        $pdf = PDF::loadView('pages.cashier.laporan', ['item' => $item, 'pesanan' => $pesanan]);
        return $pdf->stream('laporan'.Carbon::now().'.pdf');
    }
}
