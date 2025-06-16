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
                    {{ __('Create your account') }}
                </h2>
                <p class="auth-subtitle">
                    {{ __('Join us today! Please fill in your information.') }}
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="auth-form">
                @csrf

                <div class="form-fields">
                    <!-- Name -->
                    <div class="form-field">
                        <label for="name" class="form-label">{{ __('Full name') }}</label>
                        <input 
                            id="name" 
                            class="form-input {{ $errors->has('name') ? 'error' : '' }}" 
                            type="text" 
                            name="name" 
                            value="{{ old('name') }}" 
                            required 
                            autofocus 
                            autocomplete="name"
                            placeholder="{{ __('Full name') }}" />
                        @if ($errors->has('name'))
                            <div class="input-error">
                                @foreach ($errors->get('name') as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                    </div>

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
                            autocomplete="new-password"
                            placeholder="{{ __('Password') }}" />
                        @if ($errors->has('password'))
                            <div class="input-error">
                                @foreach ($errors->get('password') as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-field">
                        <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                        <input 
                            id="password_confirmation" 
                            class="form-input {{ $errors->has('password_confirmation') ? 'error' : '' }}"
                            type="password"
                            name="password_confirmation" 
                            required 
                            autocomplete="new-password"
                            placeholder="{{ __('Confirm password') }}" />
                        @if ($errors->has('password_confirmation'))
                            <div class="input-error">
                                @foreach ($errors->get('password_confirmation') as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Password Requirements -->
                <div class="password-requirements">
                    <p class="password-requirements-title">{{ __('Password must contain:') }}</p>
                    <ul class="password-requirements-list">
                        <li>{{ __('At least 8 characters') }}</li>
                        <li>{{ __('At least one uppercase letter') }}</li>
                        <li>{{ __('At least one lowercase letter') }}</li>
                        <li>{{ __('At least one number') }}</li>
                    </ul>
                </div>

                <div>
                    <button type="submit" class="primary-button">
                        <span class="button-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                            </svg>
                        </span>
                        {{ __('Create account') }}
                    </button>
                </div>

                <div class="auth-link">
                    <span class="auth-link-text">
                        {{ __('Already have an account?') }}
                    </span>
                    <a href="{{ route('login') }}">
                        {{ __('Sign in') }}
                    </a>
                </div>

                <!-- Terms and Privacy -->
                <div class="terms-privacy">
                    <p>
                        {{ __('By creating an account, you agree to our') }}
                        <a href="#">{{ __('Terms of Service') }}</a>
                        {{ __('and') }}
                        <a href="#">{{ __('Privacy Policy') }}</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>