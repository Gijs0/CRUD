<x-guest-layout>
    <div class="auth-container">
        <div class="auth-form-container">
            <div class="auth-brand">
                <a href="{{ route('welcome') }}">
                    <i class="fas fa-ticket-alt me-2"></i>Festival Tickets
                </a>
            </div>
            <div class="auth-header">
                <h2 class="auth-title">
                    {{ __('Sign in to your account') }}
                </h2>
                <p class="auth-subtitle">
                    {{ __('Welcome back! Please enter your details.') }}
                </p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="session-status">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="auth-form">
                @csrf

                <div class="form-fields">
                    <!-- Email Address -->
                    <div class="form-field">
                        <label for="email" class="form-label">{{ __('Email address') }}</label>
                        <input 
                            id="email" 
                            class="form-input {{ $errors->has('email') ? 'error' : '' }}" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus 
                            autocomplete="username"
                            placeholder="{{ __('Email address') }}" />
                        @if ($errors->has('email'))
                            <div class="input-error">
                                @foreach ($errors->get('email') as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Password -->
                    <div class="form-field">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input 
                            id="password" 
                            class="form-input {{ $errors->has('password') ? 'error' : '' }}"
                            type="password"
                            name="password"
                            required 
                            autocomplete="current-password"
                            placeholder="{{ __('Password') }}" />
                        @if ($errors->has('password'))
                            <div class="input-error">
                                @foreach ($errors->get('password') as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="auth-options">
                    <div class="remember-me">
                        <input 
                            id="remember_me" 
                            name="remember" 
                            type="checkbox" 
                            class="remember-checkbox">
                        <label for="remember_me" class="remember-label">
                            {{ __('Remember me') }}
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="forgot-password">
                            <a href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        </div>
                    @endif
                </div>

                <div>
                    <button type="submit" class="primary-button">
                        <span class="button-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        {{ __('Sign in') }}
                    </button>
                </div>

                <div class="auth-link">
                    <span class="auth-link-text">
                        {{ __("Don't have an account?") }}
                    </span>
                    <a href="{{ route('register') }}">
                        {{ __('Sign up') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>