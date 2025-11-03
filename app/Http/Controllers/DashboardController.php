<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Rental;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->is_admin) {
            return view('dashboard.admin', [
                'totalProducts' => Product::count(),
                'totalRentals' => Rental::count(),
                'totalUsers' => \App\Models\User::count(),
            ]);
        } else {
            return view('dashboard.user', [
                'myRentals' => Rental::where('user_id', $user->id)->latest()->get(),
            ]);
        }
    }
}
