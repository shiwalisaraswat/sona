$(document).on('click', '.status-toggle', function() {
    let $badge = $(this);
    let id = $badge.data('id');
    let url = $badge.data('url');

    $.ajax({
        url: url, // Ensure this route exists
        type: 'POST',
        data: {
            _token: document.querySelector('meta[name="csrf-token"]').content
        },
        success: function(res) {
            if (res.success) {
                // Update Text
                $badge.text(res.new_status);

                // Update Colors
                if (res.new_status === 'Active') {
                    $badge.removeClass('badge-gradient-danger').addClass('badge-gradient-success');
                } else {
                    $badge.removeClass('badge-gradient-success').addClass('badge-gradient-danger');
                }

                // Show Toastr
                toastr.success(res.message);
            }
        },
        error: function() {
            toastr.error("Something went wrong!");
        }
    });
});