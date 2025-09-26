<script>
    @if (session('swal'))
        Swal.fire(
            @json(session('swal'))
        );
    @endif
</script>

<script>
    Livewire.on('swal', (data) => {
        Swal.fire(data[0]);
    });
</script>
