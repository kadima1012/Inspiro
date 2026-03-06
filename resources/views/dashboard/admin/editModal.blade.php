<div id="editModal" class="hidden fixed z-50 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>

        <div class="relative bg-white rounded-xl shadow-2xl max-w-lg w-full max-h-[80vh] overflow-y-auto z-10">
            <div class="p-6 border-b border-slate-200">
                <h3 id="modal-title" class="text-lg font-bold text-slate-900">Edit Entity</h3>
                <input type="hidden" id="entity_type" name="entity_type" value="">
            </div>

            <div id="modal-body" class="p-6">
                <!-- Dynamic form -->
            </div>

            <div class="p-6 border-t border-slate-200 flex justify-end gap-3">
                <button type="button" onclick="closeModal()" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium px-5 py-2.5 rounded-lg text-sm transition-all duration-300">
                    Cancel
                </button>
                <button type="submit" form="editForm" class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold px-5 py-2.5 rounded-lg text-sm transition-all duration-300">
                    Save
                </button>
            </div>
        </div>
    </div>
</div>
