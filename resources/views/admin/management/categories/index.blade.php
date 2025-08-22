<x-admin-layout title="{{ __('All :name', ['name' => __('Categories')]) }}" :breadcrumb="[
    // Route Dashboard
    [
        'name' => __('Dashboard'),
        'url' => route('admin.home'),
    ],

    // Route Categories
    [
        'name' => __('Categories'),
    ],
]">
    <x-slot name="actions">
        <x-forms.title-header createRoute="admin.categories.create" modelName="Categories" />
    </x-slot>

    <section class="mt-8">
        @livewire('admin.datatables.category-datatable')
    </section>

    @push('js')
        <script>
            forms = document.querySelectorAll('.delete-resource-form');

            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: "{{ __('Are you sure?') }}",
                        text: "{{ __('You will not be able to revert this!') }}",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#E31414",
                        cancelButtonColor: "#CCCCCC",
                        confirmButtonText: "{{ __('Yes, delete it!') }}",
                        cancelButtonText: "{{ __('Cancel') }}"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        </script>
    @endpush
</x-admin-layout>
