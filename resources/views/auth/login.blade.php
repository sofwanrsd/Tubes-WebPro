<x-guest-layout>
  @php
    $showForgot = session('status') || old('_from') === 'forgot';
  @endphp

  <div class="auth-page">
    <div class="container {{ $showForgot ? 'forgot-panel-active' : '' }}" id="container">

      {{-- SIGN UP (POST /register) --}}
      <div class="form-container sign-up-container">
        <form method="POST" action="{{ route('register') }}">
          @csrf
          <h1>Create Account</h1>
          <span>or use your email for registration</span>

          <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required />
          <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required />
          <input type="password" name="password" placeholder="Password" required />
          <input type="password" name="password_confirmation" placeholder="Confirm Password" required />

          @if ($errors->any() && old('_from') !== 'forgot')
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

      {{-- SIGN IN (POST /login) --}}
      <div class="form-container sign-in-container">
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <h1>Sign in</h1>
          <span>or use your account</span>

          <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required />
          <input type="password" name="password" placeholder="Password" required />

          <a href="{{ route('password.request') }}" id="forgotLink">Forgot your password?</a>

          @if ($errors->any() && old('_from') !== 'forgot')
            <div style="margin-top:10px;color:#b91c1c;font-size:12px;text-align:left;width:100%">
              <ul style="padding-left:16px;">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <button type="submit">Sign In</button>
        </form>
      </div>

      {{-- FORGOT (POST /forgot-password -> route password.email) --}}
      <div class="form-container forgot-container">
        <form method="POST" action="{{ route('password.email') }}">
          @csrf
          <input type="hidden" name="_from" value="forgot">

          <h1>Forgot Password</h1>
          <span>We’ll send you a reset link</span>

          <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus />

          @if (session('status'))
            <div style="margin-top:10px;color:#065f46;font-size:12px;">
              {{ session('status') }}
            </div>
          @endif

          @if ($errors->any() && old('_from') === 'forgot')
            <div style="margin-top:10px;color:#b91c1c;font-size:12px;text-align:left;width:100%">
              <ul style="padding-left:16px;">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <button type="submit">Send Link</button>
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
