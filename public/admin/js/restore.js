$(document).on('click', '.restore_icon', function() {
    let url = $(this).data('url');

    Swal.fire({
        title: 'Restore this item?',
        text: "It will appear back in your active list.",
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'Yes, Restore!',
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
                type: 'POST',
                data: {
                    _token: document.querySelector('meta[name="csrf-token"]').content
                },
                success: function(res) {
                    if (res.success) {
                        toastr.success(res.message);
                        // Reload to refresh the action buttons (Edit/Delete)
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }
                },
                error: function() {
                    toastr.error("Failed to restore record.");
                }
            });
        }
    });
});