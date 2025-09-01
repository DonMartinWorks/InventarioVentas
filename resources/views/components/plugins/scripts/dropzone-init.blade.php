@props(['imagesValue' => []])

<script>
    Dropzone.options.myDropzone = {
        init: function() {
            let myDropzone = this;
            let images = @json($imagesValue);
            let storageBaseUrl = '{{ Storage::url('') }}';

            images.forEach(function(image) {
                let mockFile = {
                    id: image.id,
                    name: image.path.split('/').pop(),
                    size: image.size
                }

                let imageUrl = storageBaseUrl + image.path;

                myDropzone.displayExistingFile(mockFile, imageUrl);
            });
        }
    };
</script>
