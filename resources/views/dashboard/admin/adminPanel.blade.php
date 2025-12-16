<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin') }}
        </h2>
    </x-slot>

    <div class="mt-8 bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
    @if (session('error'))
        <div class="bg-red-200 text-red-600 text-center font-bold text-lg p-3 rounded">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="bg-green-200 text-green-600 text-center font-bold text-lg p-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-8 bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
        <h3 class="text-lg font-semibold mb-2">Pending Artworks Table</h3>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-center px-4 py-2">Artwork ID</th>
                    <th class="text-center px-4 py-2">Title</th>
                    <th class="text-center px-4 py-2">Description</th>
                    <th class="text-center px-4 py-2">Artist</th>
                    <th class="text-center px-4 py-2">Creation Date</th>
                    <th class="text-center px-4 py-2">Visible</th>
                    <th class="text-center px-4 py-2">Status</th>
                    <th class="text-center px-4 py-2">Image</th>
                    <th class="text-center px-4 py-2">Actions</th>


                </tr>
            </thead>
            <tbody>
            @foreach($pendingArtworks as $index => $artwork)
            <tr class="{{ $index % 2 === 0 ? 'bg-gray-100' : 'bg-white' }}">
                <td class="text-center px-4 py-2">{{ $artwork->idArt }}</td>
                <td class="text-center px-4 py-2">{{ $artwork->art_Title }}</td>
                <td class="text-center px-4 py-2">{{ $artwork->art_Description }}</td>
                <td class="text-center px-4 py-2">{{ $artwork->artist->artist_name }}</td>
                <td class="text-center px-4 py-2">{{ $artwork->art_creation_date }}</td>
                <td class="text-center px-4 py-2">{{ $artwork->art_Visible }}</td>
                <td class="text-center px-4 py-2">{{ $artwork->art_Status }}</td>
                <td class="text-center px-4 py-2">
                    @if($artwork->filepath)
                        <img src="{{ asset(Storage::url($artwork->filepath)) }}" alt="Artwork Image" class="w-16 h-16">
                    @else
                        No Image
                    @endif
                </td>
                <td class="text-center px-4 py-2">
                    <button class="bg-red-600 text-white px-4 py-2 rounded-md mr-2" onclick="acceptArtwork('{{ $artwork->idArt }}')">Accept</button>
                    <button class="bg-red-600 text-white px-4 py-2 rounded-md" onclick="declineArtwork('{{ $artwork->idArt }}')">Decline</button>
                </td>
            @endforeach


            </tbody>
        </table>

    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="relative">
                    <button class="text-sm border-2 border-gray-300 rounded-md p-2" onclick="toggleDropdown()">
                        {{ __('Select Table') }}
                        <span class="ml-1">&#9662;</span>
                    </button>
                    <div id="dropdownContent" class="hidden absolute bg-white border border-gray-200 mt-2 py-2 w-48 rounded-md shadow-lg z-10">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="showUsersTable()">
                            {{ __('User Table') }}
                        </a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="showArtistsTable()">
                            {{ __('Artist Table') }}
                        </a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="showArtworksTable()">
                            {{ __('Artwork Table') }}
                        </a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="showShopListsTable()">
                            {{ __('Shoplist Table') }}
                        </a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="showOrdersTable()">
                            {{ __('Orders Table') }}
                        </a>

                    </div>
                </div>

                <div class="mt-8">
                    <div id="usersTable" class="hidden">
                        <h3 class="text-lg font-semibold mb-2">User Table</h3>
                        <button class="bg-red-600 text-white px-4 py-2 rounded-md mb-2" onclick="openCreateModal('user')">+</button>

                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="text-center">User ID</th>
                                    <th class="text-center">First Name</th>
                                    <th class="text-center">Last Name</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Roles</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr onclick="selectRow(this)">
                                    <td class="text-center">{{ $user->idUser }}</td>
                                    <td class="text-center">{{ $user->user_first_name }}</td>
                                    <td class="text-center">{{ $user->user_last_name }}</td>
                                    <td class="text-center">{{ $user->user_username }}</td>
                                    <td class="text-center">{{ $user->email }}</td>
                                    <td class="text-center">
                                        @foreach($user->roles as $role)
                                            {{ $role->name }}
                                            @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        <button class="bg-red-600 text-white px-4 py-2 rounded-md" onclick="openAssignRoleModal('{{ $user->idUser }}', '{{ $user->user_first_name }}', '{{ $user->user_last_name }}', '{{ $user->user_username }}', '{{ $user->email }}')">Assign Role</button>
                                    </td>


                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4 mb-6">
                            {{ $users->links() }}
                        </div>
                    </div>

                    <div id="artistsTable" class="hidden mt-8">
                        <h3 class="text-lg font-semibold mb-2">Artists Table</h3>
                        <button class="bg-red-600 text-white px-4 py-2 rounded-md mb-2" onclick="openCreateModal('artist')">+</button>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="text-center">Artist ID</th>
                                    <th class="text-center">First Name</th>
                                    <th class="text-center">Last Name</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Experience</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($artists as $artist)
                                <tr onclick="selectRow(this)" data-id="{{ $artist->idArtist }}">
                                    <td class="text-center">{{ $artist->idArtist }}</td>
                                    <td class="text-center">{{ $artist->artist_first_name }}</td>
                                    <td class="text-center">{{ $artist->artist_last_name }}</td>
                                    <td class="text-center">{{ $artist->artist_description }}</td>
                                    <td class="text-center">{{ $artist->artist_experience }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4 mb-6">
                            {{ $artists->links() }}
                        </div>
                    </div>


                    <div id="artworksTable" class="hidden mt-8">
                        <h3 class="text-lg font-semibold mb-2">Artworks Table</h3>
                        <button class="bg-red-600 text-white px-4 py-2 rounded-md mb-2" onclick="openCreateModal('artwork')">+</button>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="text-center">Artwork ID</th>
                                    <th class="text-center">Title</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Artist First Name</th>
                                    <th class="text-center">Artist Last Name</th>
                                    <th class="text-center">Creation Date</th>
                                    <th class="text-center">Visible</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($artworks as $artwork)
                                <tr onclick="selectRow(this)" data-id="{{ $artwork->idArt }}">
                                    <td class="text-center">{{ $artwork->idArt }}</td>
                                    <td class="text-center">{{ $artwork->art_Title }}</td>
                                    <td class="text-center">{{ $artwork->art_Description }}</td>
                                    <td class="text-center">{{ $artwork->artist->artist_first_name }}</td>
                                    <td class="text-center">{{ $artwork->artist->artist_last_name }}</td>
                                    <td class="text-center">{{ $artwork->art_creation_date }}</td>
                                    <td class="text-center">{{ $artwork->art_Visible }}</td>
                                    <td class="text-center">{{ $artwork->art_Status }}</td>
                                    <td class="text-center">{{ $artwork->artworktype->type_name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4 mb-6">
                            {{ $artworks->links() }}
                        </div>
                    </div>

                    <div id="shopListsTable" class="hidden mt-8">
                        <h3 class="text-lg font-semibold mb-2">Shoplist Table</h3>
                        <button class="bg-red-600 text-white px-4 py-2 rounded-md mb-2" onclick="openCreateModal('shoplists')">+</button>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="text-center">Artist</th>
                                    <th class="text-center">Art Title</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Item Price</th>
                                    <th class="text-center">Quantity for Sale</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($shoplists as $item)
                                <tr onclick="selectRow(this)" data-id="{{ $item->id }}">
                                    <td class="text-center">{{ $item->artist->artist_first_name }} {{ $item->artist->artist_last_name }}</td>
                                    <td class="text-center">{{ $item->artwork->art_Title }}</td>
                                    <td class="text-center px-4 py-2">
                                        @if($artwork->filepath)
                                            <img src="{{ asset(Storage::url($item->artwork->filepath)) }}" alt="Artwork Image" class="w-16 h-16">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $item->item_price }}</td>
                                    <td class="text-center">{{ $item->quantity_for_sale }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4 mb-6">
                            {{ $shoplists->links() }}
                        </div>
                    </div>

                    <div id="ordersTable" class="hidden mt-8">
                        <h3 class="text-lg font-semibold mb-2">Orders Table</h3>
                        <button class="bg-red-600 text-white px-4 py-2 rounded-md mb-2" onclick="openCreateModal('order')">+</button>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="text-center">Order ID</th>
                                    <th class="text-center">User</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr onclick="selectRow(this)" data-id="{{ $order->idOrder }}">
                                    <td class="text-center">{{ $order->idOrder }}</td>
                                    <td class="text-center">{{ $order->user->user_username }}</td>
                                    <td class="text-center">{{ $order->order_status }}</td>
                                    <td class="text-center">{{ $order->order_details }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4 mb-6">
                            {{ $orders->links() }}
                        </div>
                    </div>






                    <div id="editButton" class="hidden mt-4">
                        <button class="bg-red-600 text-white px-4 py-2 rounded-md" onclick="editSelected()">Edit Selected</button>
                    </div>
                    <div id="deleteButton" class="hidden mt-4">
                        <button class="bg-red-600 text-white px-4 py-2 rounded-md" onclick="deleteSelected()">Delete Selected</button>
                    </div>

                </div>
            </div>
        </div>
    </div>



<script>
    let selectedRow = null;
    let selectedTable = null;

document.addEventListener("DOMContentLoaded", function() {
    const selectedTable = localStorage.getItem('selectedTable');
    toggleDropdown()
    if (selectedTable) {
        switch (selectedTable) {
            case 'users':
                showUsersTable();
                break;
            case 'artists':
                showArtistsTable();
                break;
            case 'artworks':
                showArtworksTable();
                break;
            case 'shoplists':
                showShopListsTable();
                break;
            case 'orders':
                showOrdersTable();
                break;
            default:
                showUsersTable();
        }
    } else {
        showUsersTable();
    }
});


function toggleDropdown() {
    var dropdown = document.getElementById('dropdownContent');
    dropdown.classList.toggle('hidden');
}

function showUsersTable() {
    hideAllTables();
    document.getElementById('usersTable').classList.remove('hidden');
    selectedTable = 'users';
    selectedRow = null;
    hideEditButton();
    toggleDropdown();
    localStorage.setItem('selectedTable', 'users');
}

function showArtistsTable() {
    hideAllTables();
    document.getElementById('artistsTable').classList.remove('hidden');
    selectedTable = 'artists';
    selectedRow = null;
    hideEditButton();
    toggleDropdown();
    localStorage.setItem('selectedTable', 'artists');
}

function showArtworksTable() {
    hideAllTables();
    document.getElementById('artworksTable').classList.remove('hidden');
    selectedTable = 'artworks';
    selectedRow = null;
    hideEditButton();
    toggleDropdown();
    localStorage.setItem('selectedTable', 'artworks');
}

function showShopListsTable() {
    hideAllTables();
    document.getElementById('shopListsTable').classList.remove('hidden');
    selectedTable = 'shoplists';
    selectedRow = null;
    hideEditButton();
    toggleDropdown();
    localStorage.setItem('selectedTable', 'shoplists');
}

function showOrdersTable() {
    hideAllTables();
    document.getElementById('ordersTable').classList.remove('hidden');
    selectedTable = 'orders';
    selectedRow = null;
    hideEditButton();
    toggleDropdown();
    localStorage.setItem('selectedTable', 'orders');
}


    function hideAllTables() {
        if (selectedRow) {
            selectedRow.classList.remove('bg-gray-100');
        }
        document.getElementById('usersTable').classList.add('hidden');
        document.getElementById('artistsTable').classList.add('hidden');
        document.getElementById('artworksTable').classList.add('hidden');
        document.getElementById('shopListsTable').classList.add('hidden');
        document.getElementById('ordersTable').classList.add('hidden');


    }

    function selectRow(row) {
        if (selectedRow) {
            selectedRow.classList.remove('bg-gray-100');
        }
        selectedRow = row;
        selectedRow.classList.add('bg-gray-100');
        showEditButton();
        showDeleteButton();
    }

    function showEditButton() {
        document.getElementById('editButton').classList.remove('hidden');
    }

    function hideEditButton() {
        document.getElementById('editButton').classList.add('hidden');
        hideDeleteButton();
    }

    function showDeleteButton() {
    document.getElementById('deleteButton').classList.remove('hidden');
    }

    function hideDeleteButton() {
        document.getElementById('deleteButton').classList.add('hidden');
    }


function editSelected() {
    if (selectedRow && selectedTable) {
        let entityId = selectedRow.cells[0].textContent.trim();
        let entityType = selectedTable.slice(0, -1);

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
                    { id: 'art_creation_date', label: 'Creation Date', type: 'date', name: 'art_creation_date', value: selectedRow.cells[5].textContent.trim() },
                    { id: 'art_Visible', label: 'Visible', type: 'checkbox', name: 'art_Visible', value: selectedRow.cells[6].textContent.trim() === 'true' ? true : false },
                    { id: 'art_Status', label: 'Status', type: 'text', name: 'art_Status', value: selectedRow.cells[7].textContent.trim() },
                ];


                break;
            case 'shoplists':
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
            default:
                console.log("Unknown table selected");
                return;
        }

        openEditModal('Edit ' + entityType.charAt(0).toUpperCase() + entityType.slice(1), fields, entityType, 'edit', entityId);
    }
}


function deleteSelected() {
    if (selectedRow && selectedTable) {
        const entityId = selectedRow.cells[0].textContent.trim();
        const entityType = selectedTable.slice(0, -1);
        if (confirm('Are you sure you want to delete this ' + entityType + '?')) {
            fetch(`{{url('/admin/delete')}}/${entityType}/${entityId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(entityType.charAt(0).toUpperCase() + entityType.slice(1) + ' deleted successfully.');
                    window.location.reload();
                } else {
                    alert('Failed to delete ' + entityType + '. Please try again.');
                    console.error(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while deleting the ' + entityType + '.');
            });
        }
    }
}




function openEditModal(title, fields, entityType, action = 'edit', entityId = null) {
    document.getElementById('modal-title').innerText = title;
    document.getElementById('entity_type').value = entityType;

    const modalBody = document.getElementById('modal-body');
    modalBody.innerHTML = '';

    const form = document.createElement('form');
    form.setAttribute('id', 'editForm');
    form.setAttribute('method', 'POST');
    form.setAttribute('enctype', 'multipart/form-data');
    form.setAttribute('action', action === 'edit' ? `{{url('/admin/update')}}/${entityType}` : `{{url('/admin/create')}}/${entityType}`);

    if (action === 'edit') {
        const entityIdInput = document.createElement('input');
        entityIdInput.setAttribute('type', 'hidden');
        entityIdInput.setAttribute('name', 'id');
        entityIdInput.setAttribute('value', entityId);
        form.appendChild(entityIdInput);
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const csrfInput = document.createElement('input');
    csrfInput.setAttribute('type', 'hidden');
    csrfInput.setAttribute('name', '_token');
    csrfInput.setAttribute('value', csrfToken);
    form.appendChild(csrfInput);

    fields.forEach(field => {
    const fieldWrapper = document.createElement('div');
    fieldWrapper.classList.add('mb-4');

    const label = document.createElement('label');
    label.classList.add('block', 'text-gray-700', 'text-sm', 'font-bold', 'mb-2');
    label.setAttribute('for', field.id);
    label.innerText = field.label;
    fieldWrapper.appendChild(label);

    if (field.type === 'select') {
        const select = document.createElement('select');
        select.classList.add('shadow', 'appearance-none', 'border', 'rounded', 'w-full', 'py-2', 'px-3', 'text-gray-700', 'leading-tight', 'focus:outline-none', 'focus:shadow-outline');
        select.setAttribute('id', field.id);
        select.setAttribute('name', field.name);

        // Add options to select
        field.options.forEach(option => {
            const optionElement = document.createElement('option');
            optionElement.setAttribute('value', option.toLowerCase());
            optionElement.textContent = option;
            select.appendChild(optionElement);
        });
            fieldWrapper.appendChild(select);
        } else {
            const input = document.createElement('input');
            input.classList.add('shadow', 'appearance-none', 'border', 'rounded', 'w-full', 'py-2', 'px-3', 'text-gray-700', 'leading-tight', 'focus:outline-none', 'focus:shadow-outline');
            input.setAttribute('id', field.id);
            input.setAttribute('type', field.type);
            input.setAttribute('name', field.name);
            input.setAttribute('value', field.value);

            if (field.type === 'file') {
                input.setAttribute('accept', 'image/*');
            }
            fieldWrapper.appendChild(input);
        }
        form.appendChild(fieldWrapper);
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
                { id: 'role', label: 'Role', type: 'select', name: 'role', options: ['Admin', 'Editor', 'User','Artist'] }

            ];
            break;
            case 'artist':
            const userIdField = {
                id: 'idUser',
                label: 'idUser',
                type: 'text',
                name: 'user_id',
                value: ''
            };
            fields.push(userIdField);
            fields.push(
                { id: 'artist_first_name', label: 'First Name', type: 'text', name: 'artist_first_name', value: '' },
                { id: 'artist_last_name', label: 'Last Name', type: 'text', name: 'artist_last_name', value: '' },
                { id: 'artist_description', label: 'Description', type: 'text', name: 'artist_description', value: '' },
                { id: 'artist_experience', label: 'Experience', type: 'text', name: 'artist_experience', value: '' }
            );
            break;
        case 'artwork':
            const artistIdField = {
                id: 'idArtist',
                label: 'idArtist',
                type: 'text',
                name: 'artist_id',
                value: ''
            };
            fields.push(artistIdField);
            fields.push(
                { id: 'art_Title', label: 'Title', type: 'text', name: 'art_Title', value: '' },
                { id: 'art_Description', label: 'Description', type: 'text', name: 'art_Description', value: '' },
                { id: 'art_creation_date', label: 'Creation Date', type: 'date', name: 'art_creation_date', value: '' },
                { id: 'art_Visible', label: 'Visible', type: 'checkbox', name: 'art_Visible', value: false },
                { id: 'art_Status', label: 'Status', type: 'text', name: 'art_Status', value: '' },
                { id: 'filepath', label: 'Filepath', type: 'file', name: 'filepath', value: '', required: true },
                { id: 'type', label: 'Type', type: 'select', name: 'type', options: ['Painting', 'Sculpture', 'Photography','Drawing','Digital Art'] },
                { id: 'quantity', label: 'Quantity', type: 'text', name: 'art_quantity', value: '' }

            );
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

        default:
            console.log("Unknown entity type");
            return;
    }

    openEditModal(title, fields, entityType, 'create');
}



function closeModal() {
    document.getElementById('editModal').classList.add('hidden');
    resetState();
}

function resetState() {
    if (selectedRow) {
        selectedRow.classList.remove('bg-gray-100');
    }
    selectedRow = null;
    hideEditButton();
    hideDeleteButton();
    window.location.reload();

}

function acceptArtwork(artworkId) {
    fetch(`{{ url('/admin/updateStatus') }}/${artworkId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            art_Status: 'Active'
        })
    })
    .then(response => {
        if (response.ok) {
            alert('Artwork accepted successfully.');
            window.location.reload();
        } else {
            alert('Failed to accept artwork. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while accepting artwork.');
    });
}

function declineArtwork(artworkId) {
    fetch(`{{ url('/admin/updateStatus') }}/${artworkId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            art_Status: 'Declined'
        })
    })
    .then(response => {
        if (response.ok) {
            alert('Artwork declined successfully.');
            window.location.reload();
        } else {
            alert('Failed to decline artwork. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while declining artwork.');
    });
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
        var userId = document.getElementById('userId').value;
        var roleId = document.getElementById('role').value;

        fetch(`{{url('/assign-role')}}/` + userId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                role: roleId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                closeModal();
            } else {
                alert('Error assigning role: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while assigning role.');
        });
    }


</script>




    @include('dashboard.admin.editModal')
    @include('dashboard.admin.addRole')


</x-app-layout>
