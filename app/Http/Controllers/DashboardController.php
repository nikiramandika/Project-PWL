<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

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
        $newClientsYesterday = User::whereDate('created_at', Carbon::yesterday())->count();
        $difference = $newClientsToday - $newClientsYesterday;
        $percentageChange = 0;

        if ($newClientsYesterday != 0) {
            $percentageChange = ($difference / $newClientsYesterday) * 100;
        }

        $difference = $todaysMoney - $yesterdaysMoney;
        $percentageIncrease = ($difference / $yesterdaysMoney) * 100;

        $totalSales = Order::sum('grand_total');

        if ($totalSales > 100000000) {
            $totalSales = '100.000.000++';
        } else {
            $totalSales = 'Rp ' . number_format($totalSales, 0, ',', '.');
        }

        // Get monthly orders data
        $monthlyOrders = Order::selectRaw('SUM(grand_total) as total, MONTH(created_at) as month')
            ->groupBy('month')
            ->pluck('total', 'month');

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $monthlyData = array_fill(0, 12, 0);

        foreach ($monthlyOrders as $month => $total) {
            $monthlyData[$month - 1] = $total;
        }

        $maxUsers = 100; // Nilai maksimum untuk progress bar
        $percentageUsers = min(100, ($totalUsers / $maxUsers) * 100); // Pastikan nilai maksimum tidak lebih dari 100%

        // Count active products
        $activeProductsCount = Product::where('is_active', 1)->count();

        // Set the maximum active products for the progress bar
        $maxActiveProducts = 100; // This is your target value

        // Calculate the percentage for the progress bar
        $activeProductsPercentage = min(100, ($activeProductsCount / $maxActiveProducts) * 100);

        // Calculate weekly order data
        $weekDays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $weeklyDayData = [];

        foreach ($weekDays as $index => $day) {
            $totalForDay = Order::whereRaw('WEEKDAY(created_at) = ?', [$index])->sum('grand_total');
            $weeklyDayData[$day] = $totalForDay;
        }

        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfLastWeek = Carbon::now()->subWeek()->endOfWeek();

        $usersThisWeek = User::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        $usersLastWeek = User::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count();

        // Calculate the percentage change in active users compared to last week
        $userPercentageChange = 0;
        if ($usersLastWeek != 0) {
            $userDifference = $usersThisWeek - $usersLastWeek;
            $userPercentageChange = ($userDifference / $usersLastWeek) * 100;
        }

        return view(
            'dashboard',
            compact(
                'todaysMoney',
                'percentageIncrease',
                'totalUsers',
                'newClientsToday',
                'percentageChange',
                'totalSales',
                'monthlyData',
                'months',
                'percentageUsers',
                'activeProductsCount',
                'activeProductsPercentage',
                'weekDays',
                'weeklyDayData',
                'userPercentageChange' // Pass the user percentage change to the view

            )
        );
    }
}
