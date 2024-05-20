<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function index()
    {
        $today = Carbon::now()->toDateString();
        $yesterday = Carbon::yesterday()->toDateString();

        $todaysMoney = Order::whereDate('created_at', $today)->sum('grand_total');
        $yesterdaysMoney = Order::whereDate('created_at', $yesterday)->sum('grand_total');
        $totalUsers = User::count();
        $newClientsToday = User::whereDate('created_at', Carbon::today())->count();

        // Mengambil jumlah pengguna baru yang mendaftar kemarin
        $newClientsYesterday = User::whereDate('created_at', Carbon::yesterday())->count();

        // Menghitung perbedaan antara jumlah pengguna baru hari ini dan kemarin
        $difference = $newClientsToday - $newClientsYesterday;

        // Inisialisasi persentase perubahan
        $percentageChange = 0;

        // Memastikan bahwa jumlah pengguna baru kemarin tidak nol sebelum melakukan pembagian
        if ($newClientsYesterday != 0) {
            $percentageChange = ($difference / $newClientsYesterday) * 100;
        }

        // Hitung perbedaan antara nilai hari ini dan kemarin
        $difference = $todaysMoney - $yesterdaysMoney;

        // Hitung persentase peningkatan
        $percentageIncrease = ($difference / $yesterdaysMoney) * 100;

        $totalSales = Order::sum('grand_total');

        // Memeriksa apakah total penjualan melebihi 100.000.000
        if ($totalSales > 100000000) {
            $totalSales = '100.000.000++';
        } else {
            // Format total penjualan menjadi format mata uang Rupiah
            $totalSales = 'Rp ' . number_format($totalSales, 0, ',', '.');
        }

        return view('dashboard', compact('todaysMoney', 'percentageIncrease', 'totalUsers', 'newClientsToday', 'percentageChange', 'totalSales'));
    }



}
