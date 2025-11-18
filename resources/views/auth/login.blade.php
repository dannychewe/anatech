<x-guest-layout>

<style>
    body {
        background: #f5f7fb;
        font-family: 'Inter', sans-serif;
    }

    .login-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 28px 32px;
        max-width: 380px;
        margin: 0 auto;
        box-shadow: 0 4px 18px rgba(0,0,0,0.06);
    }

    .login-title {
        font-size: 22px;
        font-weight: 600;
        color: #111827;
    }

    .login-sub {
        font-size: 14px;
        color: #6b7280;
        margin-top: 4px;
    }

    .login-input {
        border-radius: 8px;
        border: 1px solid #d1d5db;
        padding: 10px 12px;
        width: 100%;
        background: #fff;
        transition: border 0.2s ease;
        font-size: 14px;
    }

    .login-input:focus {
        outline: none;
        border-color: #0e63ff;
    }

    .submit-btn {
        background: #0e63ff;
        color: white;
        border-radius: 8px;
        width: 100%;
        padding: 10px;
        font-size: 14px;
        font-weight: 500;
        transition: 0.2s ease;
    }

    .submit-btn:hover {
        background: #0b54d4;
    }

    .brand-logo {
        height: 60px;
        margin-bottom: 15px;
    }

    .forgot-link,
    .register-link {
        color: #0e63ff;
        font-size: 13px;
        text-decoration: none;
    }

    .forgot-link:hover,
    .register-link:hover {
        text-decoration: underline;
    }
</style>


<div class="min-h-screen flex flex-col justify-center px-4">

    

    <!-- LOGIN CARD -->
    <div class="login-card">
        <!-- Header Logo + Title -->
    <div class="text-center mb-6">
        <img src="{{ asset('assets/img/logo/logo.png') }}" class="brand-logo mx-auto" alt="Logo">
        <h1 class="login-title">Sign in to your account</h1>
        <p class="login-sub">Access the Anatech admin dashboard</p>
    </div>

        <!-- Session messages -->
        <x-auth-session-status class="mb-3 text-sm text-green-600" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <x-input-label for="email" value="Email" class="text-sm font-medium text-gray-700" />
                <input id="email"
                       type="email"
                       name="email"
                       class="login-input mt-1"
                       value="{{ old('email') }}"
                       required autofocus>
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-500 text-sm" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" value="Password" class="text-sm font-medium text-gray-700" />
                <input id="password"
                       type="password"
                       name="password"
                       class="login-input mt-1"
                       required>
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-500 text-sm" />
            </div>

            <!-- Remember & Forgot -->
            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center text-gray-700 text-sm">
                    <input type="checkbox" name="remember"
                           class="rounded border-gray-300 mr-2">
                    Remember me
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">
                        Forgot password?
                    </a>
                @endif
            </div>

            <!-- Submit -->
            <button class="submit-btn">Log in</button>

        </form>
    </div>

    <!-- Footer -->
    <p class="text-center text-gray-500 text-sm mt-6">
        © {{ date('Y') }} Analytical Technologies Zambia Ltd.
    </p>

</div>

</x-guest-layout>
