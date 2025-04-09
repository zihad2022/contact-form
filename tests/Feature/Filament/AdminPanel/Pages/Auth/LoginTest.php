<?php

declare(strict_types=1);

use App\Filament\Pages\Auth\Login;
use App\Models\User;
use Filament\Facades\Filament;
use Livewire\Livewire;

use function Pest\Livewire\livewire;

it('populates the login form in the local environment', function () {
    // Simulate local environment
    app()->detectEnvironment(fn () => 'local');

    livewire(Login::class)
        ->assertSetStrict('data.email', config('larament.super_admin.email'))
        ->assertSetStrict('data.password', config('larament.super_admin.password'))
        ->assertSetStrict('data.remember', true);
});

it('does not populate the login form in non-local environments', function () {
    // Simulate production environment
    app()->detectEnvironment(fn () => 'production');

    Livewire::test(Login::class)
        ->assertSetStrict('data.email', null)
        ->assertSetStrict('data.password', null)
        ->assertSetStrict('data.remember', false);
});

test('unauthenticated user can access the login page', function () {
    $this->get(Filament::getLoginUrl())
        ->assertOk();
});

test('unauthenticated user can not access the admin panel', function () {
    $this->get('admin')
        ->assertRedirect(Filament::getLoginUrl());
});

test('unauthenticated user can login', function () {
    $admin = User::factory()->create([
        'password' => 'password',
    ]);

    livewire(Login::class)
        ->fillForm([
            'email' => $admin->email,
            'password' => 'password',
        ])
        ->assertActionExists('authenticate')
        ->call('authenticate')
        ->assertHasNoFormErrors();
});

test('authenticated user can access the admin panel', function () {
    $user = User::factory()->create([
        'password' => 'password',
    ]);

    $this->actingAs($user)
        ->get('/admin')
        ->assertOk();
});

test('authenticated user can logout', function () {
    $user = User::factory()->create(['password' => 'password',
    ]);

    $this->actingAs($user)
        ->post(Filament::getLogoutUrl())
        ->assertRedirect(Filament::getLoginUrl());
});
