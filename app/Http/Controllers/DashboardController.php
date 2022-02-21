<?php

namespace App\Http\Controllers;

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
        $pesanan = Pesanan::count();

        // if(request()->has('d')) {
        //     $data = Pesanan::with('menu')
        //                     ->where('status', 'DIANTAR')
        //                     ->whereRaw('DATE(created_at) = ?', [request()->d])
        //                     ->groupBy('menu_id')
        //                     ->having('menu_id', '>', 0)
        //                     ->get(['menu_id','jumlah']);
        // } else {
        //     $object = Carbon::now();
        //     $date = $object->toDateString();
        //     $data = Pesanan::with('menu')
        //                     ->where('status', 'DIANTAR')
        //                     ->whereRaw('DATE(created_at) = ?', [$date])
        //                     ->groupBy('menu_id')
        //                     ->having('menu_id', '>', 0)
        //                     ->get(['menu_id','jumlah']);
        // }

        $object = Carbon::now();
            $date = $object->toDateString();

        $data = Menu::with('pesanan')
                    ->get();


        // $data = Menu::leftJoin('pesanan', 'menu.id', '=', 'pesanan.menu_id')
        //             ->select('menu.*', 'pesanan.*')
        //             // ->whereRaw('DATE(pesanan.created_at) = ?', [$date])
        //             ->get();
        // dd($data);


        $total = 0;
        if($data) {
            foreach ($data as $d) {
                $total += $d->harga * $d->pesanan->sum('jumlah');
            }
        }


        // Chart
        $start = new Carbon();
        $day = cal_days_in_month(CAL_GREGORIAN, date('m'), date('y'));
        $orders = Transaksi::whereBetween('created_at', [$start->format('Y-m')."-01"." 00:00:00",
                                                    $start->format('Y-m') . "-" . $day . " 23:59:59"])->get();

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
                    $mon++;
                    break;
                case 'Tue-' . date('m'):
                    $tues++;
                    break;
                case 'Wed-' . date('m'):
                    $wed++;
                    break;
                case 'Thu-' . date('m'):
                    $thurs++;
                    break;
                case 'Fri-' . date('m'):
                    $fri++;
                    break;
                case 'Sat-' . date('m'):
                    $sat++;
                    break;
                case 'Sun-' . date('m'):
                    $sun++;
                    break;
            }
        }


        return view('pages.admin.index', compact(
                                            'menu', 'user', 'transaksi', 'pesanan', 'data', 'total',
                                            'day', 'orders', 'mon', 'tues', 'wed', 'thurs', 'fri',
                                            'sat', 'sun',
        ));
    }

    public function laporan(Request $request)
    {
        $item = $request->all();

        $waktu = $item['waktu'];

        return redirect()->route('dashboard', ['d' => $waktu]);
    }

    public function cetakLaporan($total)
    {
        $data = Menu::with('pesanan')->get();
        $carbon = Carbon::now();
        $waktu = $carbon->toDateString();

        $pdf = PDF::loadView('pages.admin.laporan', ['data' => $data, 'total' => $total, 'waktu' => $waktu]);
        return $pdf->stream('laporan'.Carbon::now().'.pdf');


    }

}
