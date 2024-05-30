<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\StrongPassword;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]*$/'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'digits:11'],
            'address' => ['required', 'string', 'max:255'],
            'zip' => ['required', 'digits:4'],
            'password' => ['required', 'string', 'min:8','confirmed', new StrongPassword],
        ]);
        

        $user = User::create([
            'first_name' => strip_tags(trim($request->first_name)),
            'last_name' => strip_tags(trim($request->last_name)),
            'email' => strip_tags(trim($request->email)),
            'phone' => strip_tags(trim($request->phone)),
            'address' => strip_tags(trim($request->address)),
            'zip' => strip_tags(trim($request->zip)),
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
