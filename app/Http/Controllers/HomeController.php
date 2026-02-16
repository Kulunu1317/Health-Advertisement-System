<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    public function index()
    {
        $ads = Advertisement::with(['user', 'purchase.package'])
            ->where('is_approved', true)
            ->whereHas('purchase', function ($query) {
                $query->where('is_active', true);
            })
            ->latest()
            ->get();

        $tierOrder = ['diamond', 'gold', 'silver', 'normal'];

        $groupedAds = collect($tierOrder)
            ->mapWithKeys(function (string $tier) use ($ads): array {
                $tierAds = $ads
                    ->filter(fn ($ad) => (($ad->purchase->tier ?? 'normal') === $tier))
                    ->values();

                return [$tier => $tierAds];
            })
            ->filter(fn (Collection $tierAds) => $tierAds->isNotEmpty());

        return view('home.index', compact('groupedAds'));
    }
}