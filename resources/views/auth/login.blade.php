<head>

  @include('common.styles')

<style>
body {
    background-image: url('/images/login1.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    min-height: 100vh;
    margin: 0;
    font-family: 'Nunito', sans-serif;
}

.login-container {
    background: rgba(255, 255, 255, 0.9); /* Optional: Add a semi-transparent background for better readability */
    border-radius: 8px;
    padding: 2rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
</style>


@include('common.welcomeheader')
</head>
<br>
<br>
<x-guest-layout>
    <div class="flex items-center justify-center">
        <!-- SVG Image Container -->
        <div class="hidden md:block w-2/3 lg:w-1/2 p-6">
            <img src="/images/s1.svg" alt="Login Image" class="w-full h-auto">
        </div>
        
        <!-- Form Container with Background -->
        
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <h1 class="text-center text-3xl uppercase mb-6">Welcome Back!</h1>
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-purple shadow-sm focus:ring-purple" name="remember">
                    <span class="ms-2 text-black font-bold hover:text-purple">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('register') }}" class="text-sm mr-6 text-black font-bold hover:text-purple">Not a
                    Registered User?</a>
                @if (Route::has('password.request'))
                    <a class="text-sm text-black font-bold hover:text-purple rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
<br>
<br>
<br>
<br>
<br>
                <x-primary-button class="ms-4 text-black font-bold hover:text-purple">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
            </form>
        </div>
    </div>
</x-guest-layout>
@include('common.footer')