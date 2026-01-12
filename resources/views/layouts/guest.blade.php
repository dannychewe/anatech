<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <style>
            body {
                margin: 0;
                font-family: "Figtree", "Segoe UI", sans-serif;
                color: #0f172a;
                background: #f8fafc;
            }
            .auth-shell {
                min-height: 100vh;
                position: relative;
                overflow: hidden;
                display: grid;
                grid-template-columns: 1fr;
            }
            @media (min-width: 992px) {
                .auth-shell {
                    grid-template-columns: 1fr 1fr;
                }
            }
            .auth-blob {
                position: absolute;
                width: 280px;
                height: 280px;
                border-radius: 999px;
                filter: blur(60px);
                opacity: 0.7;
            }
            .auth-blob--left {
                top: -80px;
                left: -80px;
                background: #d1fae5;
            }
            .auth-blob--right {
                top: 30%;
                right: -80px;
                background: #fde68a;
            }
            .auth-panel {
                padding: 48px;
                background: linear-gradient(135deg, #064e3b, #0f766e, #0f172a);
                color: #fff;
                display: none;
                flex-direction: column;
                justify-content: space-between;
                position: relative;
                z-index: 1;
            }
            @media (min-width: 992px) {
                .auth-panel {
                    display: flex;
                }
            }
            .auth-panel__logo img {
                height: 40px;
            }
            .auth-panel__title {
                font-size: 36px;
                font-weight: 600;
                letter-spacing: -0.02em;
                margin: 0;
            }
            .auth-panel__copy {
                margin-top: 16px;
                color: #d1fae5;
                max-width: 420px;
                line-height: 1.5;
            }
            .auth-panel__foot {
                font-size: 13px;
                color: #a7f3d0;
            }
            .auth-form-wrap {
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 32px 24px;
                position: relative;
                z-index: 1;
            }
            .auth-card {
                width: 100%;
                max-width: 420px;
                border-radius: 24px;
                border: 1px solid #e2e8f0;
                background: rgba(255, 255, 255, 0.95);
                padding: 40px 32px;
                box-shadow: 0 1px 0 rgba(15, 23, 42, 0.04);
            }
            .auth-card__brand {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 28px;
            }
            .auth-card__brand img {
                height: 36px;
            }
            .auth-card__badge {
                font-size: 10px;
                letter-spacing: 0.2em;
                text-transform: uppercase;
                color: #64748b;
            }
        </style>
        <div class="auth-shell">
            <div class="auth-blob auth-blob--left"></div>
            <div class="auth-blob auth-blob--right"></div>
            <div class="auth-panel">
                <div>
                    <a href="/" class="auth-panel__logo">
                        <img src="{{ asset('assets/img/logo/white-logo.png') }}" alt="{{ config('app.name') }}">
                    </a>
                </div>
                <div>
                    <h1 class="auth-panel__title">Admin Console</h1>
                    <p class="auth-panel__copy">
                        Manage product categories, inventory, bookings, and campaigns in one place.
                    </p>
                </div>
                <div class="auth-panel__foot">
                    Matcon Systems - Secure access only
                </div>
            </div>

            <div class="auth-form-wrap">
                <div class="auth-card">
                    <div class="auth-card__brand">
                        <a href="/">
                            <img src="{{ asset('assets/img/logo/logo.png') }}" alt="{{ config('app.name') }}">
                        </a>
                        <span class="auth-card__badge">Admin</span>
                    </div>
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>


