<script>
    function getMasterClass() {
        $.ajax({
            type: "GET",
            url: '{{ route('superadmin.master-class.index') }}',
            success: function(response) {
                $.each(response, function(i, master) {
                    $('#master').append($('<option>', {
                        value: master.id,
                        text: master.name
                    }));
                });
            },
        })
    }
</script>
