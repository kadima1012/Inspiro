$(document).ready(function() {
  $('#delete-selected-users').click(function() {
      var selectedUsers = [];
      
      // Parcurgeți toate casetele de selectare a utilizatorilor
      $('input[name="selected_user"]:checked').each(function() {
          selectedUsers.push($(this).val());
      });
      
      // Verificăm dacă s-au selectat utilizatori
      if (selectedUsers.length > 0) {
          // Trimiteți o cerere AJAX către backend pentru a șterge utilizatorii selectați
          $.ajax({
              url: '/delete-users',
              type: 'POST',
              data: {
                  selectedUsers: selectedUsers
              },
              success: function(response) {
                  // Reîncărcați pagina sau faceți orice alte acțiuni necesare după ștergere
                  location.reload();
              },
              error: function(xhr, status, error) {
                  // Tratați erorile în mod adecvat
                  console.error(xhr.responseText);
              }
          });
      } else {
          // Afisati un mesaj sau faceti altceva daca nu sunt utilizatori selectati
          alert('Nu ați selectat niciun utilizator pentru ștergere.');
      }
  });
});
