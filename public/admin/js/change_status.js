$(document).on('click', '.status-toggle', function() {
    let $badge = $(this);
    let id = $badge.data('id');

    // Add a trailing slash so we can just append the ID
    let baseUrl = "{{ route('admin.room_types.change_status', ':id') }}";
    let url = baseUrl.replace(':id', id);
    console.log('Final URL: ' + url);

    $.ajax({
        url: url, // Ensure this route exists
        type: 'POST',
        data: { _token: '{{ csrf_token() }}' },
        success: function(response) {
            if (response.success) {
                // Update Text
                $badge.text(response.new_status);

                // Update Colors
                if (response.new_status === 'Active') {
                    $badge.removeClass('badge-gradient-danger').addClass('badge-gradient-success');
                } else {
                    $badge.removeClass('badge-gradient-success').addClass('badge-gradient-danger');
                }

                // Show Toastr
                toastr.success(response.message);
            }
        },
        error: function() {
            toastr.error("Something went wrong!");
        }
    });
});