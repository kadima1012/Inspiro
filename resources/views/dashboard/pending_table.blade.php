<section>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">ID</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($pendingArtworks as $artwork)
                <tr class="hover:bg-slate-50 transition-colors duration-200">
                    <td class="px-6 py-4 text-sm text-slate-700">{{ $artwork->id }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
