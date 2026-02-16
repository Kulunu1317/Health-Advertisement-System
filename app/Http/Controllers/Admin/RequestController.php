<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RenewalRequest;
use App\Models\TimeExtensionRequest;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function approveRenewal(RenewalRequest $renewalRequest)
    {
        $purchase = $renewalRequest->purchase;
        $purchase->update([
            'end_date' => now()->addMinutes($purchase->package->validity_minutes)
        ]);
        $renewalRequest->update(['status' => 'approved']);
        return back()->with('success', 'Renewal approved.');
    }

    public function rejectRenewal(RenewalRequest $renewalRequest)
    {
        $renewalRequest->update(['status' => 'rejected']);
        return back()->with('success', 'Renewal rejected.');
    }

    public function approveTimeExtension(TimeExtensionRequest $timeExtensionRequest)
    {
        $ad = $timeExtensionRequest->advertisement;
        $ad->update([
            'expires_at' => $ad->expires_at->addMinutes($timeExtensionRequest->extension_minutes)
        ]);
        $timeExtensionRequest->update(['status' => 'approved']);
        return back()->with('success', 'Time extension approved.');
    }

    public function rejectTimeExtension(TimeExtensionRequest $timeExtensionRequest)
    {
        $timeExtensionRequest->update(['status' => 'rejected']);
        return back()->with('success', 'Time extension rejected.');
    }
}