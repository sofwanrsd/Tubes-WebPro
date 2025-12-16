<x-guest-layout>
    <div class="auth-page">
        <div class="container" id="container">

            {{-- REGISTER FORM (POST /register) --}}
            <div class="container right-panel-active" id="container">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <h1>Create Account</h1>
                    <span>or use your email for registration</span>

                    <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required autofocus />
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required />
                    <input type="password" name="password" placeholder="Password" required />
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required />

                    @if ($errors->any())
                        <div style="margin-top:10px;color:#b91c1c;font-size:12px;text-align:left;width:100%">
                            <ul style="padding-left:16px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button type="submit">Sign Up</button>
                </form>
            </div>

            {{-- LOGIN FORM (POST /login) --}}
            <div class="form-container sign-in-container">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h1>Sign in</h1>
                    <span>or use your account</span>

                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required />
                    <input type="password" name="password" placeholder="Password" required />

                    <div style="width:100%; text-align:left; margin-top:6px;">
                        <label style="font-size:12px;">
                            <input type="checkbox" name="remember" style="width:auto; margin-right:6px;">
                            Remember me
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Forgot your password?</a>
                    @endif

                    <button type="submit">Sign In</button>
                </form>
            </div>

            {{-- OVERLAY --}}
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Welcome Back!</h1>
                        <p>To keep connected with us please login with your personal info</p>
                        <button class="ghost" type="button" id="signIn">Sign In</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Hello, Friend!</h1>
                        <p>Enter your personal details and start journey with us</p>
                        <button class="ghost" type="button" id="signUp">Sign Up</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-guest-layout>
