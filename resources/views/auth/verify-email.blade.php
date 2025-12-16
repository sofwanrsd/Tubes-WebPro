<x-guest-layout>
  <div class="auth-page">
    <div class="container auth-single">
      <div class="form-container sign-in-container">
        <form method="POST" action="{{ route('verification.send') }}">
          @csrf
          <h1>Verify Email</h1>
          <span>Check your inbox</span>

          <p style="font-size:12px;line-height:18px;margin:12px 0;">
            We’ve sent you a verification link. Click it to activate your account.
          </p>

          @if (session('status') === 'verification-link-sent')
            <div style="margin-top:10px;color:#065f46;font-size:12px;">
              New verification link sent ✅
            </div>
          @endif

          <button type="submit">Resend Link</button>
        </form>

        <form method="POST" action="{{ route('logout') }}" style="margin-top:10px;">
          @csrf
          <button type="submit" class="ghost" style="border-color:#FF4B2B;color:#FF4B2B;">Logout</button>
        </form>
      </div>

      <div class="overlay-container">
        <div class="overlay">
          <div class="overlay-panel overlay-right">
            <h1>One More Step</h1>
            <p>Verify your email to unlock full access.</p>

            {{-- IMPORTANT: ini bukan link ke /login langsung (biar gak loop).
                 Tombol ini logout via JS, lalu redirect ke login. --}}
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
