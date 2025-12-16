$(document).ready(function() {
    $('#delete-selected-users').click(function() {
        var selectedUsers = [];
        
        $('input[name="selected_user"]:checked').each(function() {
            selectedUsers.push($(this).val());
        });
        
        if (selectedUsers.length > 0) {
            $.ajax({
                url: '/delete-users',
                type: 'POST',
                data: {
                    selectedUsers: selectedUsers
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        } else {
            alert('Nu ați selectat niciun utilizator pentru ștergere.');
        }
    });
});
