<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Purchase;
use App\Models\Advertisement;

class CheckExpiredPackages extends Command
{
    protected $signature = 'packages:check-expired';
    protected $description = 'Deactivate expired packages and remove associated ads';

    public function handle()
    {
        /** @var \Illuminate\Database\Eloquent\Collection<int, Purchase> $expired */
        $expired = Purchase::where('is_active', true)
            ->where('end_date', '<', now())
            ->get();

        foreach ($expired as $purchase) {
            /** @var Purchase $purchase */
            $purchase->update(['is_active' => false]);
            Advertisement::where('purchase_id', $purchase->id)->delete();
            $this->info("Package purchase {$purchase->id} expired and ads removed.");
        }

        return 0;
    }
}