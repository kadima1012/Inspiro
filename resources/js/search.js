//if($('#searchInput').selected=true){}
$('#searchInput').on('input', function() {
    var query = $(this).val().trim();

    if (query.length >= 2) {
        $.ajax({
            url: '{{ route("search") }}',
            method: 'GET',
            data: { query: query },
            success: function(response) {
                if (response && response.length > 0) {
                    var html = '';

                    var limitedResults = response.slice(0, 5);

                    limitedResults.forEach(function(result) {
                        html += '<a href="#" class="text-sky-400">' + result.name + ' - ' + result.email + '</a><br>';
                    });

                    $('#searchResults').html(html);
                    $('#searchResults').show();
                } else {
                    $('#searchResults').hide();
                }
            }
        });
    } else {
        $('#searchResults').hide();
    }
});
