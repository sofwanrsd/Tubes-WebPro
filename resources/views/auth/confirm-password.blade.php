<x-guest-layout>
  <div class="auth-page">
    <div class="container auth-single">
      <div class="form-container sign-in-container">
        <form method="POST" action="{{ route('password.confirm') }}">
          @csrf

          <h1>Confirm Password</h1>
          <span>Security check</span>

          <input type="password" name="password" placeholder="Password" required autocomplete="current-password" />

          @if ($errors->any())
            <div style="margin-top:10px;color:#b91c1c;font-size:12px;text-align:left;width:100%">
              <ul style="padding-left:16px;">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <button type="submit">Confirm</button>
        </form>
      </div>

      <div class="overlay-container">
        <div class="overlay">
          <div class="overlay-panel overlay-right">
            <h1>Stay Safe</h1>
            <p>Please re-enter your password to continue.</p>

            <button
              class="ghost"
              type="button"
              data-logout-to-login
              data-logout-url="{{ route('logout') }}"
              data-login-url="{{ route('login') }}"
            >
              SIGN IN
            </button>

          </div>
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>
