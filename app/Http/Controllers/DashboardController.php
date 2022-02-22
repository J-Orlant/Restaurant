<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class DashboardController extends Controller
{

    public function index()
    {

        $menu = Menu::count();
        $user = User::count();
        $transaksi = Transaksi::count();
        $meja = Meja::count();

        $object = Carbon::now();
        $waktu = $object->toDateString();

        if(request()->has('d')) {
            $data = Pesanan::with('menu')
                            ->where('status', 'DIANTAR')
                            ->whereRaw('DATE(created_at) = ?', [request()->d])
                            ->get(['menu_id','jumlah']);
        } else {
            $data = Pesanan::with('menu')
                            ->where('status', 'DIANTAR')
                            ->whereRaw('DATE(created_at) = ?', [$waktu])
                            ->get(['menu_id','jumlah']);
        }
        $laporan = [];
        foreach ($data as $key => $query) {
            if(isset($laporan[$query->menu_id])) {
                $laporan[$query->menu_id]['jumlah'] += $query->jumlah;
            } else {
                $laporan[$query->menu_id] = [
                'gambar' => $query->menu->gambar,
                'nama_menu' => $query->menu->nama_menu,
                'harga' => $query->menu->harga,
                'jumlah' => $query->jumlah,
            ];
            }
        }

        $total = 0;
        if($laporan) {
            foreach ($laporan as $d) {
                $total += $d['harga'] * $d['jumlah'];
            }
        }

        // Chart
        $start = new Carbon();
        $day = cal_days_in_month(CAL_GREGORIAN, date('m'), date('y'));
        $orders = Transaksi::whereBetween('created_at', [$start->format('Y-m')."-01"." 00:00:00",
                                                    $start->format('Y-m') . "-" . $day . " 23:59:59"])->where('status', 'LUNAS')->get();

        // dd($orders);
        $mon = 0;
        $tues = 0;
        $wed = 0;
        $thurs = 0;
        $fri = 0;
        $sat = 0;
        $sun = 0;
        foreach ($orders as $order) {
            $date = $order->created_at;
            switch ($date->format('D-m')) {
                case 'Mon-' . date('m'):
                    $mon += $order->total;
                    break;
                case 'Tue-' . date('m'):
                    $tues += $order->total;
                    break;
                case 'Wed-' . date('m'):
                    $wed += $order->total;
                    break;
                case 'Thu-' . date('m'):
                    $thurs += $order->total;
                    break;
                case 'Fri-' . date('m'):
                    $fri += $order->total;
                    break;
                case 'Sat-' . date('m'):
                    $sat += $order->total;
                    break;
                case 'Sun-' . date('m'):
                    $sun += $order->total;
                    break;
            }
        }

        // Pie Chart
        $admin = User::where('level', 'ADMIN')->count();
        $waiters = User::where('level', 'WAITER')->count();
        $cashier = User::where('level', 'CASHIER')->count();


        return view('pages.admin.index', compact(
                                            'menu', 'user', 'transaksi', 'meja', 'laporan', 'total',
                                            'mon', 'tues', 'wed', 'thurs', 'fri', 'sat', 'sun', 'waktu',
                                            'admin', 'waiters', 'cashier',
        ));
    }

    public function laporan(Request $request)
    {
        $item = $request->all();

        $waktu = $item['waktu'];

        return redirect()->route('dashboard', ['d' => $waktu]);
    }

    public function cetakLaporan($tanggal)
    {
        $data = Pesanan::with('menu')
                            ->where('status', 'DIANTAR')
                            ->whereRaw('DATE(created_at) = ?', [$tanggal])
                            ->get(['menu_id','jumlah']);

        $laporan = [];
        foreach ($data as $key => $query) {
            if(isset($laporan[$query->menu_id])) {
                $laporan[$query->menu_id]['jumlah'] += $query->jumlah;
            } else {
                $laporan[$query->menu_id] = [
                'gambar' => $query->menu->gambar,
                'nama_menu' => $query->menu->nama_menu,
                'harga' => $query->menu->harga,
                'jumlah' => $query->jumlah,
            ];
            }
        }

        $total = 0;
        if($laporan) {
            foreach ($laporan as $d) {
                $total += $d['harga'] * $d['jumlah'];
            }
        }

        $pdf = PDF::loadView('pages.admin.laporan', ['data' => $laporan, 'total' => $total, 'waktu' => $tanggal]);
        return $pdf->stream('laporan'.$tanggal.'.pdf');


    }

}
