<x-app-layout>
    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-xl font-bold mb-4">Checkout</h2>

            <div class="bg-white shadow rounded p-6">
                <div class="space-y-2">
                    @foreach($items as $it)
                        <div class="flex justify-between border-b pb-2">
                            <div>{{ $it['title'] }}</div>
                            <div>Rp {{ number_format($it['price'], 0, ',', '.') }}</div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4 font-bold">
                    Subtotal: Rp {{ number_format($subtotal, 0, ',', '.') }}
                </div>

                <form method="POST" action="{{ route('checkout.submit') }}" class="mt-6 space-y-4">
                    @csrf

                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="agree" value="1">
                        <span>Saya menyetujui Syarat & Ketentuan</span>
                    </label>
                    @error('agree')
                        <div class="text-red-600 text-sm">{{ $message }}</div>
                    @enderror

                    <button class="px-4 py-2 bg-black text-white rounded">Buat Order & Lanjut Bayar</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
