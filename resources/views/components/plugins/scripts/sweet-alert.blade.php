<script>
    @if (session('swal'))
        Swal.fire(
            @json(session('swal'))
        );
    @endif
</script>
