<x-guest-layout>
  <div class="auth-page">
    <div class="container auth-single">
      <div class="form-container sign-in-container">
        <form method="POST" action="{{ route('password.store') }}">
          @csrf

          <h1>Reset Password</h1>
          <span>Set your new password</span>

          <input type="hidden" name="token" value="{{ $request->route('token') }}"/>

          <input type="email" name="email" placeholder="Email"
                 value="{{ old('email', $request->email) }}" required autofocus />

          <input type="password" name="password" placeholder="New Password" required />
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

          <button type="submit">Reset</button>
          <a href="{{ route('login') }}">Back to Sign In</a>
        </form>
      </div>

      <div class="overlay-container">
        <div class="overlay">
          <div class="overlay-panel overlay-right">
            <h1>Almost There!</h1>
            <p>Make it strong and easy to remember.</p>
            <a href="{{ route('login') }}">
              <button class="ghost" type="button">SIGN IN</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>
