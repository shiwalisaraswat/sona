$(document).on('click', '.force_delete_icon', function() {
    let url = $(this).data('url');
    let $row = $(this).closest('tr');

    Swal.fire({
        title: 'PERMANENT DELETE?',
        text: "This will remove the record from the database FOREVER!",
        icon: 'error', // Error icon for dangerous actions
        showCancelButton: true,
        confirmButtonText: 'Yes, Wipe it!',
        buttonsStyling: false,
        customClass: {
            confirmButton: 'btn btn-danger mx-2',
            cancelButton: 'btn btn-light mx-2'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    _token: document.querySelector('meta[name="csrf-token"]').content
                },
                success: function(res) {
                    if (res.success) {
                        $row.fadeOut(500, function() { $(this).remove(); });
                        toastr.error(res.message); // Using error toast for "Deleted"
                    }
                }
            });
        }
    });
});
