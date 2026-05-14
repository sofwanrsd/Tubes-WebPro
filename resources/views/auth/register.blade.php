<x-guest-layout>
  <div class="auth-page">
    <div class="container right-panel-active" id="container">

      {{-- SIGN UP (POST /register) --}}
      <div class="form-container sign-up-container">
        <form method="POST" action="{{ route('register') }}">
          @csrf
          <h1>Create Account</h1>
          <span>or use your email for registration</span>

          <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required autofocus />
          <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required />
          
          <div style="position:relative;width:100%">
            <input type="password" name="password" id="regPassword" placeholder="Password" required style="padding-right:40px" />
            <button type="button" onclick="togglePassword('regPassword', 'regEye')" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;padding:0">
              <svg id="regEye" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
              </svg>
            </button>
          </div>

          <div style="position:relative;width:100%">
            <input type="password" name="password_confirmation" id="regConfirm" placeholder="Confirm Password" required style="padding-right:40px" />
            <button type="button" onclick="togglePassword('regConfirm', 'regConfirmEye')" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;padding:0">
              <svg id="regConfirmEye" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
              </svg>
            </button>
          </div>

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

      {{-- SIGN IN (POST /login) --}}
      <div class="form-container sign-in-container">
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <h1>Sign in</h1>
          <span>or use your account</span>

          <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required />

          <div style="position:relative;width:100%">
            <input type="password" name="password" id="regLoginPassword" placeholder="Password" required style="padding-right:40px" />
            <button type="button" onclick="togglePassword('regLoginPassword', 'regLoginEye')" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;padding:0">
              <svg id="regLoginEye" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
              </svg>
            </button>
          </div>

          <a href="{{ route('password.request') }}">Forgot your password?</a>

          <button type="submit">Sign In</button>
        </form>
      </div>

      {{-- OVERLAY --}}
      <div class="overlay-container">
        <div class="overlay">
          <div class="overlay-panel overlay-left">
            <h1>Welcome Back!</h1>
            <p>Already have an account? Login here</p>
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
