<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">{{ __('Admin Panel') }}</h2>
    </x-slot>

    <div class="py-12" x-data="{
        activeTab: localStorage.getItem('adminTab') || 'pending',
        selectedRow: null,
        selectedTable: null,
        setTab(tab) {
            this.activeTab = tab;
            this.selectedRow = null;
            localStorage.setItem('adminTab', tab);
        },
        selectRow(row, table) {
            if (this.selectedRow) this.selectedRow.classList.remove('bg-amber-50');
            this.selectedRow = row;
            this.selectedTable = table;
            row.classList.add('bg-amber-50');
        }
    }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">{{ session('error') }}</div>
            @endif
            @if (session('success'))
                <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm">{{ session('success') }}</div>
            @endif

            <!-- Tab Navigation -->
            <div class="bg-white rounded-xl shadow-lg mb-6 overflow-hidden">
                <div class="flex flex-wrap border-b border-slate-200">
                    <button @click="setTab('pending')" :class="activeTab === 'pending' ? 'text-amber-600 border-b-2 border-amber-500 bg-amber-50' : 'text-slate-500 hover:text-slate-700'" class="px-5 py-3 text-sm font-medium transition-all duration-300">Pending</button>
                    <button @click="setTab('users')" :class="activeTab === 'users' ? 'text-amber-600 border-b-2 border-amber-500 bg-amber-50' : 'text-slate-500 hover:text-slate-700'" class="px-5 py-3 text-sm font-medium transition-all duration-300">Users</button>
                    <button @click="setTab('artists')" :class="activeTab === 'artists' ? 'text-amber-600 border-b-2 border-amber-500 bg-amber-50' : 'text-slate-500 hover:text-slate-700'" class="px-5 py-3 text-sm font-medium transition-all duration-300">Artists</button>
                    <button @click="setTab('artworks')" :class="activeTab === 'artworks' ? 'text-amber-600 border-b-2 border-amber-500 bg-amber-50' : 'text-slate-500 hover:text-slate-700'" class="px-5 py-3 text-sm font-medium transition-all duration-300">Artworks</button>
                    <button @click="setTab('shop')" :class="activeTab === 'shop' ? 'text-amber-600 border-b-2 border-amber-500 bg-amber-50' : 'text-slate-500 hover:text-slate-700'" class="px-5 py-3 text-sm font-medium transition-all duration-300">Shop</button>
                    <button @click="setTab('orders')" :class="activeTab === 'orders' ? 'text-amber-600 border-b-2 border-amber-500 bg-amber-50' : 'text-slate-500 hover:text-slate-700'" class="px-5 py-3 text-sm font-medium transition-all duration-300">Orders</button>
                </div>
            </div>

            <!-- Pending Artworks Tab -->
            <div x-show="activeTab === 'pending'" x-transition class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <h3 class="text-lg font-bold text-slate-900">Pending Artworks</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">ID</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Title</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Artist</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Date</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Image</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($pendingArtworks as $artwork)
                            <tr class="hover:bg-slate-50 transition-colors duration-200">
                                <td class="px-4 py-3 text-sm text-slate-700">{{ $artwork->idArt }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-slate-900">{{ $artwork->art_Title }}</td>
                                <td class="px-4 py-3 text-sm text-slate-700">{{ $artwork->artist->artist_name }}</td>
                                <td class="px-4 py-3 text-sm text-slate-500">{{ $artwork->art_creation_date }}</td>
                                <td class="px-4 py-3"><span class="text-xs font-medium px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-800">{{ $artwork->art_Status }}</span></td>
                                <td class="px-4 py-3">
                                    @if($artwork->filepath)
                                        <img src="{{ asset(Storage::url($artwork->filepath)) }}" alt="Artwork" class="w-12 h-12 rounded-lg object-cover">
                                    @else
                                        <span class="text-xs text-slate-400">No image</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex gap-2">
                                        <button onclick="acceptArtwork('{{ $artwork->idArt }}')" class="bg-emerald-500 hover:bg-emerald-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition-all duration-300">Accept</button>
                                        <button onclick="declineArtwork('{{ $artwork->idArt }}')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition-all duration-300">Decline</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Users Tab -->
            <div x-show="activeTab === 'users'" x-transition class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-slate-900">Users</h3>
                    <button onclick="openCreateModal('user')" class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-medium px-4 py-2 rounded-lg text-sm transition-all duration-300">+ Create User</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">ID</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">First Name</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Last Name</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Username</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Email</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Roles</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($users as $user)
                            <tr class="hover:bg-slate-50 transition-colors duration-200 cursor-pointer" onclick="selectRow(this)">
                                <td class="px-4 py-3 text-sm text-slate-700">{{ $user->idUser }}</td>
                                <td class="px-4 py-3 text-sm text-slate-700">{{ $user->user_first_name }}</td>
                                <td class="px-4 py-3 text-sm text-slate-700">{{ $user->user_last_name }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-slate-900">{{ $user->user_username }}</td>
                                <td class="px-4 py-3 text-sm text-slate-500">{{ $user->email }}</td>
                                <td class="px-4 py-3">
                                    @foreach($user->roles as $role)
                                        <span class="inline-block text-xs font-medium px-2 py-0.5 rounded-full bg-indigo-100 text-indigo-800 mr-1">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td class="px-4 py-3">
                                    <button onclick="event.stopPropagation(); openAssignRoleModal('{{ $user->idUser }}', '{{ $user->user_first_name }}', '{{ $user->user_last_name }}', '{{ $user->user_username }}', '{{ $user->email }}')" class="bg-indigo-500 hover:bg-indigo-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition-all duration-300">Assign Role</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4 border-t border-slate-100">{{ $users->links() }}</div>
            </div>

            <!-- Artists Tab -->
            <div x-show="activeTab === 'artists'" x-transition class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-slate-900">Artists</h3>
                    <button onclick="openCreateModal('artist')" class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-medium px-4 py-2 rounded-lg text-sm transition-all duration-300">+ Create Artist</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">ID</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">First Name</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Last Name</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Description</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Experience</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($artists as $artist)
                            <tr class="hover:bg-slate-50 transition-colors duration-200 cursor-pointer" onclick="selectRow(this)" data-id="{{ $artist->idArtist }}">
                                <td class="px-4 py-3 text-sm text-slate-700">{{ $artist->idArtist }}</td>
                                <td class="px-4 py-3 text-sm text-slate-700">{{ $artist->artist_first_name }}</td>
                                <td class="px-4 py-3 text-sm text-slate-700">{{ $artist->artist_last_name }}</td>
                                <td class="px-4 py-3 text-sm text-slate-500 max-w-xs truncate">{{ $artist->artist_description }}</td>
                                <td class="px-4 py-3 text-sm text-slate-700">{{ $artist->artist_experience }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4 border-t border-slate-100">{{ $artists->links() }}</div>
            </div>

            <!-- Artworks Tab -->
            <div x-show="activeTab === 'artworks'" x-transition class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-slate-900">Artworks</h3>
                    <button onclick="openCreateModal('artwork')" class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-medium px-4 py-2 rounded-lg text-sm transition-all duration-300">+ Create Artwork</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">ID</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Title</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Description</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Artist</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Date</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Visible</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Type</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($artworks as $artwork)
                            <tr class="hover:bg-slate-50 transition-colors duration-200 cursor-pointer" onclick="selectRow(this)" data-id="{{ $artwork->idArt }}">
                                <td class="px-4 py-3 text-sm text-slate-700">{{ $artwork->idArt }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-slate-900">{{ $artwork->art_Title }}</td>
                                <td class="px-4 py-3 text-sm text-slate-500 max-w-xs truncate">{{ $artwork->art_Description }}</td>
                                <td class="px-4 py-3 text-sm text-slate-700">{{ $artwork->artist->artist_first_name }} {{ $artwork->artist->artist_last_name }}</td>
                                <td class="px-4 py-3 text-sm text-slate-500">{{ $artwork->art_creation_date }}</td>
                                <td class="px-4 py-3 text-sm text-slate-700">{{ $artwork->art_Visible }}</td>
                                <td class="px-4 py-3">
                                    @php
                                        $sColors = ['Active' => 'bg-emerald-100 text-emerald-800', 'Pending' => 'bg-amber-100 text-amber-800', 'Declined' => 'bg-red-100 text-red-800'];
                                    @endphp
                                    <span class="text-xs font-medium px-2.5 py-0.5 rounded-full {{ $sColors[$artwork->art_Status] ?? 'bg-slate-100 text-slate-800' }}">{{ $artwork->art_Status }}</span>
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-700">{{ $artwork->artworktype->type_name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4 border-t border-slate-100">{{ $artworks->links() }}</div>
            </div>

            <!-- Shop Tab -->
            <div x-show="activeTab === 'shop'" x-transition class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-slate-900">Shop Items</h3>
                    <button onclick="openCreateModal('shoplists')" class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-medium px-4 py-2 rounded-lg text-sm transition-all duration-300">+ Create Item</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Artist</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Artwork</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Image</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Price</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Qty for Sale</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($shoplists as $item)
                            <tr class="hover:bg-slate-50 transition-colors duration-200 cursor-pointer" onclick="selectRow(this)" data-id="{{ $item->id }}">
                                <td class="px-4 py-3 text-sm text-slate-700">{{ $item->artist->artist_first_name }} {{ $item->artist->artist_last_name }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-slate-900">{{ $item->artwork->art_Title }}</td>
                                <td class="px-4 py-3">
                                    @if($item->artwork->filepath)
                                        <img src="{{ asset(Storage::url($item->artwork->filepath)) }}" alt="Artwork" class="w-10 h-10 rounded-lg object-cover">
                                    @else
                                        <span class="text-xs text-slate-400">No image</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm font-bold text-slate-900">{{ $item->item_price }} &euro;</td>
                                <td class="px-4 py-3 text-sm text-slate-700">{{ $item->quantity_for_sale }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4 border-t border-slate-100">{{ $shoplists->links() }}</div>
            </div>

            <!-- Orders Tab -->
            <div x-show="activeTab === 'orders'" x-transition class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-slate-900">Orders</h3>
                    <button onclick="openCreateModal('order')" class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-medium px-4 py-2 rounded-lg text-sm transition-all duration-300">+ Create Order</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">ID</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">User</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Details</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($orders as $order)
                            <tr class="hover:bg-slate-50 transition-colors duration-200 cursor-pointer" onclick="selectRow(this)" data-id="{{ $order->idOrder }}">
                                <td class="px-4 py-3 text-sm text-slate-700">{{ $order->idOrder }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-slate-900">{{ $order->user->user_username }}</td>
                                <td class="px-4 py-3">
                                    @php
                                        $oColors = ['Active' => 'bg-emerald-100 text-emerald-800', 'Sent' => 'bg-blue-100 text-blue-800', 'Received' => 'bg-emerald-100 text-emerald-800', 'In Cart' => 'bg-slate-100 text-slate-800', 'Canceled' => 'bg-red-100 text-red-800'];
                                    @endphp
                                    <span class="text-xs font-medium px-2.5 py-0.5 rounded-full {{ $oColors[$order->order_status] ?? 'bg-slate-100 text-slate-800' }}">{{ $order->order_status }}</span>
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-500 max-w-xs truncate">{{ $order->order_details }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4 border-t border-slate-100">{{ $orders->links() }}</div>
            </div>

            <!-- Action Buttons (shown when a row is selected) -->
            <div id="actionButtons" class="hidden mt-4 flex gap-3">
                <button onclick="editSelected()" class="bg-slate-700 hover:bg-slate-600 text-white font-medium px-5 py-2.5 rounded-lg text-sm transition-all duration-300">Edit Selected</button>
                <button onclick="deleteSelected()" class="bg-red-600 hover:bg-red-500 text-white font-medium px-5 py-2.5 rounded-lg text-sm transition-all duration-300">Delete Selected</button>
            </div>
        </div>
    </div>

    @include('dashboard.admin.editModal')
    @include('dashboard.admin.addRole')

    @push('scripts')
    <script>
    let selectedRow = null;
    let selectedTable = null;

    function selectRow(row) {
        if (selectedRow) selectedRow.classList.remove('bg-amber-50');
        selectedRow = row;
        selectedRow.classList.add('bg-amber-50');
        const tab = localStorage.getItem('adminTab') || 'users';
        selectedTable = tab === 'pending' ? 'pending' : tab;
        document.getElementById('actionButtons').classList.remove('hidden');
    }

    function editSelected() {
        if (!selectedRow || !selectedTable) return;
        let entityId = selectedRow.cells[0].textContent.trim();
        let entityType = selectedTable.endsWith('s') ? selectedTable.slice(0, -1) : selectedTable;
        let fields = [];
        switch (selectedTable) {
            case 'users':
                fields = [
                    { id: 'user_first_name', label: 'First Name', type: 'text', name: 'user_first_name', value: selectedRow.cells[1].textContent.trim() },
                    { id: 'user_last_name', label: 'Last Name', type: 'text', name: 'user_last_name', value: selectedRow.cells[2].textContent.trim() },
                    { id: 'user_username', label: 'Username', type: 'text', name: 'user_username', value: selectedRow.cells[3].textContent.trim() },
                    { id: 'email', label: 'Email', type: 'email', name: 'email', value: selectedRow.cells[4].textContent.trim() }
                ];
                break;
            case 'artists':
                fields = [
                    { id: 'artist_first_name', label: 'First Name', type: 'text', name: 'artist_first_name', value: selectedRow.cells[1].textContent.trim() },
                    { id: 'artist_last_name', label: 'Last Name', type: 'text', name: 'artist_last_name', value: selectedRow.cells[2].textContent.trim() },
                    { id: 'artist_description', label: 'Description', type: 'text', name: 'artist_description', value: selectedRow.cells[3].textContent.trim() },
                    { id: 'artist_experience', label: 'Experience', type: 'text', name: 'artist_experience', value: selectedRow.cells[4].textContent.trim() }
                ];
                break;
            case 'artworks':
                fields = [
                    { id: 'art_Title', label: 'Title', type: 'text', name: 'art_Title', value: selectedRow.cells[1].textContent.trim() },
                    { id: 'art_Description', label: 'Description', type: 'text', name: 'art_Description', value: selectedRow.cells[2].textContent.trim() },
                    { id: 'art_creation_date', label: 'Creation Date', type: 'date', name: 'art_creation_date', value: selectedRow.cells[4].textContent.trim() },
                    { id: 'art_Visible', label: 'Visible', type: 'checkbox', name: 'art_Visible', value: selectedRow.cells[5].textContent.trim() === 'true' },
                    { id: 'art_Status', label: 'Status', type: 'text', name: 'art_Status', value: selectedRow.cells[6].textContent.trim() }
                ];
                break;
            case 'shop':
                entityType = 'shoplist';
                fields = [
                    { id: 'quantity_for_sale', label: 'Quantity for Sale', type: 'number', name: 'quantity_for_sale', value: parseInt(selectedRow.cells[4].textContent.trim()) },
                    { id: 'item_price', label: 'Item Price', type: 'number', name: 'item_price', value: parseFloat(selectedRow.cells[3].textContent.trim()) }
                ];
                break;
            case 'orders':
                fields = [
                    { id: 'order_status', label: 'Order Status', type: 'text', name: 'order_status', value: selectedRow.cells[2].textContent.trim() },
                    { id: 'order_details', label: 'Order Details', type: 'text', name: 'order_details', value: selectedRow.cells[3].textContent.trim() }
                ];
                break;
        }
        openEditModal('Edit ' + entityType.charAt(0).toUpperCase() + entityType.slice(1), fields, entityType, 'edit', entityId);
    }

    function deleteSelected() {
        if (!selectedRow || !selectedTable) return;
        const entityId = selectedRow.cells[0].textContent.trim();
        let entityType = selectedTable.endsWith('s') ? selectedTable.slice(0, -1) : selectedTable;
        if (selectedTable === 'shop') entityType = 'shoplist';
        if (confirm('Are you sure you want to delete this ' + entityType + '?')) {
            fetch(`{{url('/admin/delete')}}/${entityType}/${entityId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) { alert(entityType + ' deleted successfully.'); window.location.reload(); }
                else { alert('Failed to delete. ' + (data.message || '')); }
            })
            .catch(() => alert('An error occurred.'));
        }
    }

    function openEditModal(title, fields, entityType, action, entityId) {
        document.getElementById('modal-title').innerText = title;
        document.getElementById('entity_type').value = entityType;
        const modalBody = document.getElementById('modal-body');
        modalBody.innerHTML = '';
        const form = document.createElement('form');
        form.id = 'editForm';
        form.method = 'POST';
        form.enctype = 'multipart/form-data';
        form.action = action === 'edit' ? `{{url('/admin/update')}}/${entityType}` : `{{url('/admin/create')}}/${entityType}`;

        const csrf = document.createElement('input');
        csrf.type = 'hidden'; csrf.name = '_token';
        csrf.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        form.appendChild(csrf);

        if (action === 'edit') {
            const idInput = document.createElement('input');
            idInput.type = 'hidden'; idInput.name = 'id'; idInput.value = entityId;
            form.appendChild(idInput);
        }

        fields.forEach(field => {
            const wrap = document.createElement('div');
            wrap.className = 'mb-4';
            const label = document.createElement('label');
            label.className = 'block text-sm font-medium text-slate-700 mb-1';
            label.textContent = field.label;
            wrap.appendChild(label);
            if (field.type === 'select') {
                const sel = document.createElement('select');
                sel.className = 'w-full rounded-lg border-slate-300 focus:border-amber-500 focus:ring-amber-500';
                sel.name = field.name; sel.id = field.id;
                field.options.forEach(opt => {
                    const o = document.createElement('option');
                    o.value = opt.toLowerCase(); o.textContent = opt;
                    sel.appendChild(o);
                });
                wrap.appendChild(sel);
            } else {
                const input = document.createElement('input');
                input.className = 'w-full rounded-lg border-slate-300 focus:border-amber-500 focus:ring-amber-500';
                input.type = field.type; input.name = field.name; input.id = field.id; input.value = field.value;
                if (field.type === 'file') input.accept = 'image/*';
                wrap.appendChild(input);
            }
            form.appendChild(wrap);
        });
        modalBody.appendChild(form);
        document.getElementById('editModal').classList.remove('hidden');
    }

    function openCreateModal(entityType) {
        let fields = [];
        let title = 'Create ' + entityType.charAt(0).toUpperCase() + entityType.slice(1);
        switch (entityType) {
            case 'user':
                fields = [
                    { id: 'user_first_name', label: 'First Name', type: 'text', name: 'user_first_name', value: '' },
                    { id: 'user_last_name', label: 'Last Name', type: 'text', name: 'user_last_name', value: '' },
                    { id: 'user_username', label: 'Username', type: 'text', name: 'user_username', value: '' },
                    { id: 'email', label: 'Email', type: 'email', name: 'email', value: '' },
                    { id: 'user_birthdate', label: 'Birthdate', type: 'date', name: 'user_birthdate', value: '' },
                    { id: 'password', label: 'Password', type: 'password', name: 'password', value: '' },
                    { id: 'password_confirmation', label: 'Confirm Password', type: 'password', name: 'password_confirmation', value: '' },
                    { id: 'role', label: 'Role', type: 'select', name: 'role', options: ['Admin', 'Editor', 'User', 'Artist'] }
                ];
                break;
            case 'artist':
                fields = [
                    { id: 'idUser', label: 'User ID', type: 'text', name: 'user_id', value: '' },
                    { id: 'artist_first_name', label: 'First Name', type: 'text', name: 'artist_first_name', value: '' },
                    { id: 'artist_last_name', label: 'Last Name', type: 'text', name: 'artist_last_name', value: '' },
                    { id: 'artist_description', label: 'Description', type: 'text', name: 'artist_description', value: '' },
                    { id: 'artist_experience', label: 'Experience', type: 'text', name: 'artist_experience', value: '' }
                ];
                break;
            case 'artwork':
                fields = [
                    { id: 'idArtist', label: 'Artist ID', type: 'text', name: 'artist_id', value: '' },
                    { id: 'art_Title', label: 'Title', type: 'text', name: 'art_Title', value: '' },
                    { id: 'art_Description', label: 'Description', type: 'text', name: 'art_Description', value: '' },
                    { id: 'art_creation_date', label: 'Creation Date', type: 'date', name: 'art_creation_date', value: '' },
                    { id: 'art_Visible', label: 'Visible', type: 'checkbox', name: 'art_Visible', value: false },
                    { id: 'art_Status', label: 'Status', type: 'text', name: 'art_Status', value: '' },
                    { id: 'filepath', label: 'Image', type: 'file', name: 'filepath', value: '' },
                    { id: 'type', label: 'Type', type: 'select', name: 'type', options: ['Painting', 'Sculpture', 'Photography', 'Drawing', 'Digital Art'] },
                    { id: 'quantity', label: 'Quantity', type: 'text', name: 'art_quantity', value: '' }
                ];
                break;
            case 'shoplists':
                fields = [
                    { id: 'quantity_for_sale', label: 'Quantity for Sale', type: 'number', name: 'quantity_for_sale', value: '' },
                    { id: 'item_price', label: 'Item Price', type: 'text', name: 'item_price', value: '' }
                ];
                break;
            case 'order':
                fields = [
                    { id: 'order_status', label: 'Order Status', type: 'text', name: 'order_status', value: '' },
                    { id: 'order_details', label: 'Order Details', type: 'text', name: 'order_details', value: '' }
                ];
                break;
        }
        openEditModal(title, fields, entityType, 'create');
    }

    function closeModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.getElementById('assignRoleModal').classList.add('hidden');
        if (selectedRow) selectedRow.classList.remove('bg-amber-50');
        selectedRow = null;
        document.getElementById('actionButtons').classList.add('hidden');
        window.location.reload();
    }

    function acceptArtwork(artworkId) {
        fetch(`{{ url('/admin/updateStatus') }}/${artworkId}`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
            body: JSON.stringify({ art_Status: 'Active' })
        }).then(r => { if (r.ok) { alert('Artwork accepted.'); window.location.reload(); } else { alert('Failed.'); } }).catch(() => alert('Error.'));
    }

    function declineArtwork(artworkId) {
        fetch(`{{ url('/admin/updateStatus') }}/${artworkId}`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
            body: JSON.stringify({ art_Status: 'Declined' })
        }).then(r => { if (r.ok) { alert('Artwork declined.'); window.location.reload(); } else { alert('Failed.'); } }).catch(() => alert('Error.'));
    }

    function openAssignRoleModal(userId, firstName, lastName, username, email) {
        document.getElementById('assignRoleModal').classList.remove('hidden');
        document.getElementById('modal_user_first_name').textContent = firstName;
        document.getElementById('modal_user_last_name').textContent = lastName;
        document.getElementById('modal_user_username_value').textContent = username;
        document.getElementById('modal_user_email').textContent = email;
        document.getElementById('userId').value = userId;
    }

    function assignRole() {
        const userId = document.getElementById('userId').value;
        const roleId = document.getElementById('role').value;
        fetch(`{{url('/assign-role')}}/` + userId, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ role: roleId })
        }).then(r => r.json()).then(data => {
            if (data.success) { alert(data.message); closeModal(); } else { alert('Error: ' + data.message); }
        }).catch(() => alert('Error assigning role.'));
    }
    </script>
    @endpush
</x-app-layout>
