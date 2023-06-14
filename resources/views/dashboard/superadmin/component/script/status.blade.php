<script>
    $(document).on('click', '.status', function() {
        var id = $(this).data('id')
        var url = '{{ url()->current() }}/' + id + '/status';

        if ($(this).val() == 'active') {
            $(this).removeClass('btn-outline-success').addClass('btn-outline-danger').text('Inactive').val('inactive');
        } else if ($(this).val() == 'inactive') {
            $(this).removeClass('btn-outline-danger').addClass('btn-outline-success').text('Active').val('active');
        }

        changeStatus(url)
    });

    function changeStatus(url) {
        $.ajax({
            type: "PUT",
            url: url,
            data: {
                '_token': token,
            },
            success: function(response){
                console.log(response)
            }
        })
    }
</script>