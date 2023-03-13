<script>
    $(document).on('click', '.delete', function() {
        var title = $(this).data('title')
        var id = $(this).data('id')
        var row = $(this).parents('tr')

        Swal.fire({
            title: 'Yakin, Hapus ' + title + ' ?',
            icon: 'error',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result['isConfirmed']) {
                $.ajax({
                    type: "DELETE",
                    url: '{{ url()->current() }}/' + id + '/delete',
                    data: {
                        '_token': token,
                    },
                    success: function(data) {
                        Swal.fire(
                            'Status',
                            data['msg'],
                            data['status']
                        )
                        row.fadeOut('slow', function($row) {
                            myTable.row(row).remove().draw();
                        });
                    },
                    errors: function() {
                        Swal.fire(
                            'Whoops !',
                            'Kesalahan Sistem',
                            'error'
                        )
                    }
                })
            }
        })
    })
</script>
