<div id="assignRoleModal" class="hidden fixed z-50 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>

        <div class="relative bg-white rounded-xl shadow-2xl max-w-lg w-full z-10">
            <div class="p-6 border-b border-slate-200">
                <h3 class="text-lg font-bold text-slate-900">Assign Role</h3>
            </div>

            <div class="p-6">
                <div class="space-y-2 text-sm text-slate-600 mb-6">
                    <p><span class="font-medium text-slate-700">First Name:</span> <span id="modal_user_first_name"></span></p>
                    <p><span class="font-medium text-slate-700">Last Name:</span> <span id="modal_user_last_name"></span></p>
                    <p><span class="font-medium text-slate-700">Username:</span> <span id="modal_user_username_value"></span></p>
                    <p><span class="font-medium text-slate-700">Email:</span> <span id="modal_user_email"></span></p>
                </div>

                <form id="assignRoleForm">
                    <input type="hidden" id="userId" name="userId">
                    <div>
                        <label for="role" class="block text-sm font-medium text-slate-700 mb-1">Select Role</label>
                        <select id="role" name="role" class="w-full rounded-lg border-slate-300 focus:border-amber-500 focus:ring-amber-500 transition-all duration-300">
                            <option value="admin">Admin</option>
                            <option value="editor">Editor</option>
                            <option value="user">User</option>
                            <option value="artist">Artist</option>
                        </select>
                    </div>
                </form>
            </div>

            <div class="p-6 border-t border-slate-200 flex justify-end gap-3">
                <button type="button" onclick="closeModal()" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium px-5 py-2.5 rounded-lg text-sm transition-all duration-300">
                    Cancel
                </button>
                <button type="button" onclick="assignRole()" class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold px-5 py-2.5 rounded-lg text-sm transition-all duration-300">
                    Assign Role
                </button>
            </div>
        </div>
    </div>
</div>
