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
          
          <div style="position:relative;width:100%">
            <input type="password" name="password" id="loginPassword" placeholder="Password" required style="padding-right:40px" />
            <button type="button" onclick="togglePassword('loginPassword', 'loginEye')" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;padding:0">
              <svg id="loginEye" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
              </svg>
            </button>
          </div>

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

  <script>
    function togglePassword(inputId, eyeId) {
      const input = document.getElementById(inputId);
      const eye = document.getElementById(eyeId);
      if (input.type === 'password') {
        input.type = 'text';
        eye.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
      } else {
        input.type = 'password';
        eye.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
      }
    }
  </script>
</x-guest-layout>
