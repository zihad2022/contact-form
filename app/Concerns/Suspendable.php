<?php

declare(strict_types=1);

namespace App\Concerns;

use App\Notifications\AccountSuspendedNotification;
use App\Notifications\AccountUnsuspendedNotification;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait Suspendable
{
    /**
     * Suspend account and notify them.
     */
    public function suspend(string $reason, ?CarbonInterface $endsAt = null): void
    {
        $this->update([
            'suspended_at' => now(),
            'suspension_reason' => $reason,
            'suspension_ends_at' => $endsAt,
        ]);

        $this->notify(new AccountSuspendedNotification($this));
    }

    /**
     * Un-suspend account and notify them.
     */
    public function unsuspend(): bool
    {
        if (! $this->suspended_at) {
            return false;
        }

        $this->update([
            'suspended_at' => null,
            'suspension_reason' => null,
            'suspension_ends_at' => null,
        ]);

        $this->notify(new AccountUnsuspendedNotification($this));

        return true;
    }

    /**
     * Account is banned for lifetime.
     */
    protected function isBanned(): Attribute
    {
        return Attribute::get(fn () => $this->suspended_at && ! $this->suspension_ends_at);
    }

    /**
     * Account is suspended for some time.
     */
    protected function isSuspended(): Attribute
    {
        return Attribute::get(fn () => $this->suspended_at && $this->suspension_ends_at?->isFuture());
    }
}
