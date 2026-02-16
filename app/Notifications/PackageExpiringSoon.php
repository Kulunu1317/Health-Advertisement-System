<?php

namespace App\Notifications;

use App\Models\Purchase;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class PackageExpiringSoon extends Notification implements ShouldQueue
{
    use Queueable;

    protected $purchase;

    public function __construct(Purchase $purchase)
    {
        $this->purchase = $purchase;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "Your package '{$this->purchase->package->name}' will expire in 1 minute. Would you like to renew?",
            'purchase_id' => $this->purchase->id,
            'action_url' => route('mypackages'),
        ];
    }
}