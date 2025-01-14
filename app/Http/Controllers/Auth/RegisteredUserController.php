<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        return DB::transaction(function () use ($request) {
            $request->validate([
                'name'              => 'required|string|max:255',
                'email'             => 'required|string|lowercase|email|max:255|unique:'.User::class,
                'password'          => ['required', 'confirmed', Rules\Password::defaults()],
                'site_name'         => 'required|string|max:255|lowercase|unique:'.Tenant::class.',id',
            ]);

            $tenant = Tenant::create([
                'id'                  => $request->site_name,
                'tenancy_db_name'     => $request->site_name,
            ]);

            $tenant->domains()->create([
                'domain' => $request->site_name.'.ledger-wise.test',
            ]);

            $user = User::create([
                'tenant_id' => $tenant->id,
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
            ]);

            event(new Registered($user));

            Auth::login($user);

            return redirect(route('dashboard', absolute: false));
        });
    }
}
