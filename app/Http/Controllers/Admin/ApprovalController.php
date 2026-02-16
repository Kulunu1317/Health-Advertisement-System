<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Advertisement;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    public function approveUser(User $user)
    {
        $user->update(['is_approved' => true]);
        return back()->with('success', 'User approved.');
    }

    public function rejectUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'User rejected and removed.');
    }

    public function approveAdvertisement(Advertisement $advertisement)
    {
        $advertisement->update(['is_approved' => true]);
        return back()->with('success', 'Ad approved.');
    }

    public function rejectAdvertisement(Advertisement $advertisement)
    {
        $advertisement->delete();
        return back()->with('success', 'Ad rejected and removed.');
    }
}