<!-- addRole.blade.php -->
<div id="assignRoleModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <!-- Modal content -->
        <div class="inline-block align-middle bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <!-- Modal title -->
                <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">
                    Assign Role for <span id="modal_user_username"></span>
                </h3>
                <!-- User details -->
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <!-- User details -->
                    <p class="text-sm text-gray-500">First Name: <span id="modal_user_first_name"></span></p>
                    <p class="text-sm text-gray-500">Last Name: <span id="modal_user_last_name"></span></p>
                    <p class="text-sm text-gray-500">Username: <span id="modal_user_username_value"></span></p>
                    <p class="text-sm text-gray-500">Email: <span id="modal_user_email"></span></p>
                </div>
                <form id="assignRoleForm" class="mt-5">
                    <input type="hidden" id="userId" name="userId">
                    <div class="mb-4">
                        <label for="role" class="block text-sm font-medium text-gray-700">Select Role</label>
                        <select id="role" name="role" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="admin">Admin</option>
                            <option value="editor">Editor</option>
                            <option value="user">User</option>
                            <option value="artist">Artist</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="assignRole()" class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-gray-800 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm" id="assignRoleBtn">Assign Role</button>
                <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
            </div>
        </div>
    </div>
</div>
