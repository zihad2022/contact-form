<?php

declare(strict_types=1);

use App\Models\User;
use App\Notifications\AccountSuspendedNotification;
use App\Notifications\AccountUnsuspendedNotification;
use Illuminate\Support\Facades\Notification;

test('to array', function () {
    $user = User::factory()->create()->fresh();

    expect(array_keys($user->toArray()))->toBe([
        'id',
        'name',
        'email',
        'email_verified_at',
        'suspended_at',
        'suspension_ends_at',
        'suspension_reason',
        'created_at',
        'updated_at',
    ]);
});

it('can be suspended', function () {
    $user = User::factory()->create()->fresh();

    $user->suspend(
        reason: 'Test',
        endsAt: now()->addDays(7)
    );

    expect($user->is_suspended)->toBeTrue();
    expect($user->is_banned)->toBeFalse();
});

it('can be unsuspended', function () {
    $user = User::factory()->create()->fresh();

    $user->suspend(
        reason: 'Test',
        endsAt: now()->addDays(7)
    );

    $user->unsuspend();

    expect($user->is_suspended)->toBeFalse();
    expect($user->is_banned)->toBeFalse();
});

it('can unsuspend only if suspended', function () {
    $user = User::factory()->create()->fresh();

    expect($user->unsuspend())->toBeFalse();
});

it('can be banned', function () {
    $user = User::factory()->create()->fresh();

    $user->suspend(
        reason: 'Test',
    );

    expect($user->is_suspended)->toBeFalse();
    expect($user->is_banned)->toBeTrue();
});

it('can be unbanned', function () {
    $user = User::factory()->create()->fresh();

    $user->suspend(
        reason: 'Test',
    );

    $user->unsuspend();

    expect($user->is_suspended)->toBeFalse();
    expect($user->is_banned)->toBeFalse();
});

it('can send a suspended notification', function () {
    $user = User::factory()->create()->fresh();
    Notification::fake();

    $user->suspend(
        reason: 'Test',
        endsAt: now()->addDays(7)
    );

    expect($user->is_suspended)->toBeTrue();

    Notification::assertSentTo($user, AccountSuspendedNotification::class);
});

it('can send an unsuspended notification', function () {
    $user = User::factory()->create()->fresh();
    Notification::fake();

    $user->suspend(
        reason: 'Test',
        endsAt: now()->addDays(7)
    );

    $user->unsuspend();

    Notification::assertSentTo($user, AccountUnsuspendedNotification::class);
});
