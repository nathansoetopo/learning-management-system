<script>
    @if (Session::has('success'))
        Toastify({
            text: "{{ Session::get('success') }}",
            duration: 6000,
            close: true,
            gravity: "top",
            position: "center",
            backgroundColor: "#4fbe87",
        }).showToast();
    @endif
</script>
