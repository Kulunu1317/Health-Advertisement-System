<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Advertisement;
use App\Models\RenewalRequest;
use App\Models\TimeExtensionRequest;

class AdminController extends Controller
{
    public function dashboard()
    {
        $pendingUsers = User::where('is_approved', false)->where('is_admin', false)->get();
        $pendingAds = Advertisement::where('is_approved', false)->get();
        $pendingRenewals = RenewalRequest::where('status', 'pending')->get();
        $pendingExtensions = TimeExtensionRequest::where('status', 'pending')->get();
        return view('admin.dashboard', compact('pendingUsers', 'pendingAds', 'pendingRenewals', 'pendingExtensions'));
    }
}