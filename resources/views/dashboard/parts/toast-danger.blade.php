<script>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            Toastify({
                text: "{{$error}}",
                duration: 5000,
                close: true,
                gravity: "top",
                position: "center",
                backgroundColor: "#FF0000",
            }).showToast();
        @endforeach
    @endif
</script>