<x-admin-layout title="{{ __('Edit :name', ['name' => __('Product') . ': ' . $product->name]) }}" :breadcrumb="[
    // Route Dashboard
    [
        'name' => __('Dashboard'),
        'url' => route('admin.home'),
    ],

    // Route Products
    [
        'name' => __('Products'),
        'url' => route('admin.products.index'),
    ],

    [
        'name' => __('Edit :name', ['name' => __('Product') . ': ' . $product->name]),
    ],
]">
    @push('css')
        <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    @endpush

    <x-wire-card>
        <h2 class="text-2xl/7 font-bold text-gray-700 sm:truncate sm:text-3xl sm:tracking-tight md:mb-8 mb-3">
            {{ __('Edit :name', ['name' => __('Product') . ': ' . $product->name]) }}</h2>

        <div class="mb-4">
            <div class="rounded-md">
                <form action="{{ route('admin.products.dropzone', $product) }}" class="dropzone" id="my-dropzone"
                    method="POST">
                    @csrf
                    {{--  --}}
                </form>
            </div>
        </div>

        <x-forms.form-structure :route="route('admin.products.update', $product)" formMethod="PUT">
            @include('admin.management.products.form')

            <section class="flex justify-end">
                <x-wire-button type="submit" light gray label="{{ __('Update :name', ['name' => $product->name]) }}"
                    right-icon="check" flat interaction:solid="positive" />
            </section>
        </x-forms.form-structure>
    </x-wire-card>

    @push('js')
        <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

        {{-- <x-plugins.scripts.dropzone-init :imagesValue="$product->images" /> --}}
        <script>
            Dropzone.options.myDropzone = {
                addRemoveLinks: true,

                init: function() {
                    let myDropzone = this;
                    let images = @json($product->images);

                    images.forEach(function(image) {
                        let mockFile = {
                            id: image.id,
                            name: image.path.split('/').pop(),
                            size: image.size,
                        }

                        myDropzone.displayExistingFile(mockFile, `{{ Storage::url('${image.path}') }}`);

                        myDropzone.emit("complete", mockFile);

                        myDropzone.files.push(mockFile);
                    });

                    this.on("success", function(file, response) {
                        file.id = response.id
                    })

                    this.on("removedfile", function(file) {
                        // Route name: >> image.destroy <<
                        axios.delete(`/admin/images/${file.id}`)
                            .then(response => {
                                console.log(response.data);
                            })
                            .catch(error => {
                                console.log('====================================');
                                console.log(error);
                                console.log('====================================');
                            })
                    })
                }
            };
        </script>
    @endpush
</x-admin-layout>
