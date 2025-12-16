<x-guest-layout>
  <div class="auth-page">
    <div class="container auth-single" id="container">
      <div class="form-container sign-in-container">
        <form method="POST" action="{{ route('password.email') }}">
          @csrf
          <h1>Forgot Password</h1>
          <span>We’ll send you a reset link</span>

          <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus />

          @if (session('status'))
            <div style="margin-top:10px;color:#065f46;font-size:12px;">
              {{ session('status') }}
            </div>
          @endif

          @if ($errors->any())
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

      <div class="overlay-container">
        <div class="overlay">
          <div class="overlay-panel overlay-right">
            <h1>Reset Time!</h1>
            <p>Enter your email and we’ll help you get back in.</p>
            <a href="{{ route('login') }}">
              <button class="ghost" type="button" id="goLogin" data-href="{{ route('login') }}">SIGN IN</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>
