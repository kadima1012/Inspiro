<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Confirm basket') }}
        </h2>
    </x-slot>

    <div class="container">
        <h1>Confirm Add to Basket</h1>
        <p>Are you sure you want to add this artwork to your basket?</p>
        <p><strong>Title:</strong> {{ $artwork->art_Title }}</p>
        <p><strong>Description:</strong> {{ $artwork->art_Description }}</p>

        <form action="{{ route('add.to.basket.confirm') }}" method="POST">
            <p>
                <strong>Quantity:</strong>
                <input type="number" id="quantity_to_order" name="quantity_to_order" value="1" min="1" max="{{ $artwork->shopItem()->quantity_for_sale}}" required>
            </p>
            <img src="{{ \App\Helpers\StorageHelper::customUrl($artwork->filepath) }}" alt="{{ $artwork->art_Title }}" class="mt-2 rounded-lg w-full h-full object-cover">

            @csrf
            <input type="hidden" name="idArt" value="{{ $artwork->idArt }}">
            <input type="hidden" name="quantity" id="quantity" value="1"> <!-- Cantitatea introdusă de utilizator -->

            <button type="submit" class="bg-red-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4">
                Yes, add to basket
            </button>
        </form>
    </div>

    <script>
        // Actualizăm valoarea inputului hidden cu cantitatea introdusă de utilizator
        document.getElementById('quantity_to_order').addEventListener('input', function() {
            document.getElementById('quantity').value = this.value;
        });
    </script>
</x-app-layout>
