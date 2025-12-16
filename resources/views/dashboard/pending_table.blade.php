<section>

    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    ID
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($pendingArtworks as $artwork)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ $artwork->id }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</section>
