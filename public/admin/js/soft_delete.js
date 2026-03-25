$(document).on('click', '.soft_delete_icon', function() {
    let url = $(this).data('url');
    let $row = $(this).closest('tr');

    Swal.fire({
        title: 'Are you sure?',
        text: "This action can be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
        // Disable default SWAL button styles
        buttonsStyling: false, 
        // Inject your custom gradient classes
        customClass: {
            confirmButton: 'btn btn-gradient-danger mx-2', 
            cancelButton: 'btn btn-gradient-secondary mx-2'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: 'DELETE',
                // ❌ Old approach (works only inside Blade, not external JS)
                // data: { _token: "{{ csrf_token() }}" },

                /*
                    Correct Approach for External JS:
                    - Blade syntax does NOT work inside .js files.
                    - We fetch CSRF token from meta tag dynamically.
                    - This acts as a fallback even though ajaxSetup already sets header.
                */
                data: {
                    _token: document.querySelector('meta[name="csrf-token"]').content
                },
                success: function(res) {
                    if (res.success) {
                        $row.fadeOut(500, function() { $(this).remove(); });
                        toastr.success(res.message);
                    }
                },
                error: function() {
                    toastr.error("Could not delete this item.");
                }
            });
        }
    });
});
