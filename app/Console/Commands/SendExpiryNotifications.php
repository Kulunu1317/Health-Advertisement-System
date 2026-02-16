<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Purchase;
use App\Notifications\PackageExpiringSoon;

class SendExpiryNotifications extends Command
{
    protected $signature = 'packages:send-expiry-notifications';
    protected $description = 'Send notifications 1 minute before package expiry';

    public function handle()
    {
        /** @var \Illuminate\Database\Eloquent\Collection<int, Purchase> $soonToExpire */
        $soonToExpire = Purchase::where('is_active', true)
            ->where('end_date', '>', now())
            ->where('end_date', '<', now()->addMinute())
            ->get();

        foreach ($soonToExpire as $purchase) {
            /** @var Purchase $purchase */
            $purchase->user->notify(new PackageExpiringSoon($purchase));
        }

        $this->info('Expiry notifications sent.');
        return 0;
    }
}