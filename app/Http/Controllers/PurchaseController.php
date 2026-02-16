<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PurchaseController extends Controller
{
    public function buy(Request $request, Package $package)
    {
        $user = Auth::user();
        if (! $user instanceof User) {
            abort(403);
        }

        $lastPurchase = Purchase::where('user_id', $user->id)
            ->where('created_at', '>', now()->subMinutes(5))
            ->first();
        if ($lastPurchase) {
            return back()->with('error', 'You can only buy one package within 5 minutes.');
        }

        $availableTiers = ['normal'];
        if ($package->silver_price !== null) {
            $availableTiers[] = 'silver';
        }
        if ($package->gold_price !== null) {
            $availableTiers[] = 'gold';
        }
        if ($package->diamond_price !== null) {
            $availableTiers[] = 'diamond';
        }

        $validated = $request->validate([
            'tier' => ['nullable', Rule::in($availableTiers)],
        ]);

        $tier = $validated['tier'] ?? 'normal';
        $price = $package->price;
        if ($tier === 'silver' && $package->silver_price) {
            $price = $package->silver_price;
        } elseif ($tier === 'gold' && $package->gold_price) {
            $price = $package->gold_price;
        } elseif ($tier === 'diamond' && $package->diamond_price) {
            $price = $package->diamond_price;
        }

        $start = now();
        $end = now()->addMinutes($package->validity_minutes);

        $purchase = Purchase::create([
            'user_id' => $user->id,
            'package_id' => $package->id,
            'tier' => $tier,
            'price_paid' => $price,
            'start_date' => $start,
            'end_date' => $end,
            'is_active' => true,
        ]);

        return redirect()->route('mypackages')->with('success', 'Package purchased successfully.');
    }

    public function myPackages()
    {
        $user = Auth::user();
        if (! $user instanceof User) {
            abort(403);
        }

        $purchases = $user->purchases()->where('is_active', true)->get();
        return view('home.mypackages', compact('purchases'));
    }
}