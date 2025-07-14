<x-app-layout>
    <div class="max-w-6xl mx-auto py-10 px-6 sm:px-10">
        <!-- Welcome Section -->
        <div class="bg-white p-6 rounded-lg shadow mb-8 border border-gray-200">
            <h2 class="text-3xl font-bold text-green-700 mb-2">👋 Welcome, {{ Auth::user()->name }}!</h2>
            <p class="text-gray-700 text-base">
                Explore our premium coffee collection and place your order below. ☕<br>
                Select your favorite types and enter the quantities you'd like delivered to your address.
            </p>
        </div>@if(session('success'))
        <div class="p-4 mb-4 text-green-900 bg-green-100 border border-green-400 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="p-4 mb-4 text-red-900 bg-red-100 border border-red-400 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('orders.store') }}" method="POST" class="space-y-8">
        @csrf

        <!-- Delivery Address -->
        <div class="bg-white p-6 rounded shadow border border-gray-300">
            <label for="delivery_address" class="block text-sm font-semibold text-gray-700 mb-2">📍 Delivery Address</label>
            <textarea name="delivery_address" rows="3" required placeholder="e.g. Plot 12, Coffee Lane, Kampala" class="w-full rounded border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-green-600"></textarea>
        </div>

        <!-- Product List -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="bg-white border border-gray-200 rounded-xl shadow-md hover:shadow-lg transition duration-300 p-5">
                    <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $product->name }}</h3>
                    <p class="text-sm text-gray-600 mb-2">{{ $product->description }}</p>
                    <p class="text-sm font-semibold text-gray-800 mb-1">💰 UGX {{ number_format($product->price) }}</p>
                    <p class="text-xs text-gray-500 mb-3">Available: {{ $product->quantity }}</p>

                    <input type="hidden" name="products[]" value="{{ $product->id }}">

                    <label for="quantity" class="block text-sm text-gray-700 mb-1">Quantity</label>
                    <input type="number" name="quantities[]" min="0" max="{{ $product->quantity }}" placeholder="Enter quantity" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
            @endforeach
        </div>

        <!-- Submit -->
        <div class="text-center mt-10">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold px-8 py-3 rounded-full shadow-md transition">
                ✅ Place Order Now
            </button>
        </div>
    </form>
</div>

</x-app-layout>
