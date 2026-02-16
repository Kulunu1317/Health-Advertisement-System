<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Purchase;
use App\Models\TimeExtensionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvertisementController extends Controller
{
    public function create(Purchase $purchase)
    {
        if ($purchase->user_id != Auth::id() || !$purchase->is_active) {
            abort(403);
        }
        $adCount = $purchase->advertisements()->count();
        if ($adCount >= $purchase->package->ad_limit) {
            return back()->with('error', 'Ad limit reached for this package.');
        }
        return view('advertisements.create', compact('purchase'));
    }

    public function store(Request $request, Purchase $purchase)
    {
        $data = $request->validate([
            'medicine_name' => 'required|string|max:255',
            'medicine_type' => 'required|string|max:255',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if ($request->hasFile('company_logo')) {
            $file = $request->file('company_logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/company_logos'), $filename);
            $data['company_logo'] = 'assets/company_logos/' . $filename;
        }

        $data['user_id'] = Auth::id();
        $data['purchase_id'] = $purchase->id;
        $data['expires_at'] = $purchase->end_date;

        Advertisement::create($data);

        return redirect()->route('home')->with('success', 'Ad submitted for approval.');
    }

    public function editTime(Advertisement $advertisement)
    {
        if ($advertisement->user_id != Auth::id()) {
            abort(403);
        }
        return view('advertisements.edit_time', compact('advertisement'));
    }

    public function show(Advertisement $advertisement)
    {
        return view('advertisements.show', compact('advertisement'));
    }

    public function requestTimeExtension(Request $request, Advertisement $advertisement)
    {
        $request->validate([
            'extension_minutes' => 'required|integer|min:1'
        ]);

        TimeExtensionRequest::create([
            'user_id' => Auth::id(),
            'advertisement_id' => $advertisement->id,
            'extension_minutes' => $request->extension_minutes,
            'status' => 'pending',
        ]);

        return redirect()->route('notifications')->with('success', 'Extension request sent to admin.');
    }
}