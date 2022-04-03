$(document).on('click', '.delete_btn', function (e) {
    e.preventDefault();

    let icon_id = $(this).val();
    swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "DELETE",
                    url: "service/" + icon_id,
                    success: function (response) {
                        fetchService();
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                        });
                    }
                })

            } else {
                swal("Your data is safe!");
            }
        });
});