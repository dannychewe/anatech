<x-guest-layout>
    <style>
        .auth-title {
            font-size: 26px;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: #0f172a;
            margin: 0;
        }
        .auth-subtitle {
            margin-top: 8px;
            font-size: 14px;
            color: #64748b;
        }
        .auth-field {
            width: 100%;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 12px 14px;
            font-size: 14px;
            outline: none;
        }
        .auth-field:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }
        .auth-label {
            font-weight: 600;
            color: #334155;
            font-size: 13px;
        }
        .auth-link {
            color: #0f766e;
            font-weight: 600;
            text-decoration: none;
        }
        .auth-link:hover {
            color: #115e59;
        }
        .auth-button {
            width: 100%;
            border: none;
            border-radius: 999px;
            padding: 12px 16px;
            background: #0f766e;
            color: #ffffff;
            font-weight: 600;
            cursor: pointer;
        }
        .auth-button:hover {
            background: #115e59;
        }
        .auth-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 12px;
        }
        .auth-hint {
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
            margin-top: 16px;
        }
        .auth-remember {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #64748b;
        }
    </style>

    <h2 class="auth-title">Welcome back</h2>
    <p class="auth-subtitle">Sign in to manage the Matcon admin dashboard.</p>

    <!-- Session Status -->
    <x-auth-session-status class="mt-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" style="margin-top: 24px;">
        @csrf

        <!-- Email Address -->
        <div style="margin-bottom: 16px;">
            <x-input-label for="email" :value="__('Email')" class="auth-label" />
            <x-text-input id="email" class="auth-field" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div style="margin-bottom: 16px;">
            <x-input-label for="password" :value="__('Password')" class="auth-label" />
            <x-text-input id="password" class="auth-field" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="auth-row">
            <label for="remember_me" class="auth-remember">
                <input id="remember_me" type="checkbox" name="remember">
                <span>{{ __('Remember me') }}</span>
            </label>
            @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <div style="margin-top: 20px;">
            <x-primary-button class="auth-button">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <p class="auth-hint">
            Need help? <a href="{{ url('/contact-us') }}" class="auth-link">Contact support</a>
        </p>
    </form>
</x-guest-layout>
