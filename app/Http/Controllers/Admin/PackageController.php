<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'ad_limit' => 'required|integer|min:1',
            'validity_minutes' => 'required|integer|min:1',
            'silver_price' => 'nullable|numeric|min:0|gt:price',
            'gold_price' => 'nullable|numeric|min:0|gt:price',
            'diamond_price' => 'nullable|numeric|min:0|gt:price',
        ]);

        $validator->after(function ($validator) use ($request) {
            $silver = $request->input('silver_price');
            $gold = $request->input('gold_price');
            $diamond = $request->input('diamond_price');

            if ($silver !== null && $silver !== '' && $gold !== null && $gold !== '' && (float) $gold <= (float) $silver) {
                $validator->errors()->add('gold_price', 'Gold price must be greater than silver price.');
            }

            if ($gold !== null && $gold !== '' && $diamond !== null && $diamond !== '' && (float) $diamond <= (float) $gold) {
                $validator->errors()->add('diamond_price', 'Diamond price must be greater than gold price.');
            }

            if (($gold === null || $gold === '') && $silver !== null && $silver !== '' && $diamond !== null && $diamond !== '' && (float) $diamond <= (float) $silver) {
                $validator->errors()->add('diamond_price', 'Diamond price must be greater than silver price when gold price is not set.');
            }
        });

        $data = $validator->validate();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/package_images'), $filename);
            $data['image'] = 'assets/package_images/' . $filename;
        }

        Package::create($data);
        return redirect()->route('admin.packages.index')->with('success', 'Package created successfully.');
    }

    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'ad_limit' => 'required|integer|min:1',
            'validity_minutes' => 'required|integer|min:1',
            'silver_price' => 'nullable|numeric|min:0|gt:price',
            'gold_price' => 'nullable|numeric|min:0|gt:price',
            'diamond_price' => 'nullable|numeric|min:0|gt:price',
        ]);

        $validator->after(function ($validator) use ($request) {
            $silver = $request->input('silver_price');
            $gold = $request->input('gold_price');
            $diamond = $request->input('diamond_price');

            if ($silver !== null && $silver !== '' && $gold !== null && $gold !== '' && (float) $gold <= (float) $silver) {
                $validator->errors()->add('gold_price', 'Gold price must be greater than silver price.');
            }

            if ($gold !== null && $gold !== '' && $diamond !== null && $diamond !== '' && (float) $diamond <= (float) $gold) {
                $validator->errors()->add('diamond_price', 'Diamond price must be greater than gold price.');
            }

            if (($gold === null || $gold === '') && $silver !== null && $silver !== '' && $diamond !== null && $diamond !== '' && (float) $diamond <= (float) $silver) {
                $validator->errors()->add('diamond_price', 'Diamond price must be greater than silver price when gold price is not set.');
            }
        });

        $data = $validator->validate();

        if ($request->hasFile('image')) {
            if ($package->image && file_exists(public_path($package->image))) {
                unlink(public_path($package->image));
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/package_images'), $filename);
            $data['image'] = 'assets/package_images/' . $filename;
        }

        $package->update($data);
        return redirect()->route('admin.packages.index')->with('success', 'Package updated successfully.');
    }

    public function destroy(Package $package)
    {
        if ($package->image && file_exists(public_path($package->image))) {
            unlink(public_path($package->image));
        }
        $package->delete();
        return redirect()->route('admin.packages.index')->with('success', 'Package deleted successfully.');
    }
}