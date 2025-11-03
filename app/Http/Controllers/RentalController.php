<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Rental;

class RentalController extends Controller
{
    public function adminIndex()
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized');
        }

        $rentals = Rental::with(['user', 'product'])->latest()->get();
        return view('admin.rentals', compact('rentals'));
    }


    public function index()
    {
        $rentals = Rental::where('user_id', auth()->id())->with('product')->latest()->get();
        return view('rentals.index', compact('rentals'));
    }


    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $validated['product_id'] = $product->id;


        $isRented = Rental::where('product_id', $product->id)
            ->whereIn('status', ['pending', 'approved'])
            ->where(function ($query) use ($validated) {
                $query->whereBetween('start_date', [$validated['start_date'], $validated['end_date']])
                    ->orWhereBetween('end_date', [$validated['start_date'], $validated['end_date']])
                    ->orWhere(function ($subQuery) use ($validated) {
                        $subQuery->where('start_date', '<=', $validated['start_date'])
                            ->where('end_date', '>=', $validated['end_date']);
                    });
            })
            ->exists();

        if ($isRented) {
            return back()->with('error', 'Produk ini sedang disewa pada tanggal tersebut!');
        }


        $days = (strtotime($validated['end_date']) - strtotime($validated['start_date'])) / 86400 + 1;
        $totalPrice = $product->price * $days;

        Rental::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        $product->update(['is_available' => false]);

        return redirect()->route('rentals.index')->with('success', 'Penyewaan berhasil diajukan!');
    }


    public function updateStatus(Request $request, Rental $rental)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected,returned',
        ]);

        $rental->update(['status' => $validated['status']]);

        if (in_array($validated['status'], ['rejected', 'returned'])) {
            $rental->product->update(['is_available' => true]);
        } elseif ($validated['status'] === 'approved') {
            $rental->product->update(['is_available' => false]);
        }

        return back()->with('success', 'Status penyewaan diperbarui!');
    }
}
