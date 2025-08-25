<div class="space-y-4 mb-8">
    <x-wire-input label="{{ __('Name') }}" name="name"
        placeholder="{{ __('Please insert this information: :name', ['name' => __('Name')]) }}"
        value="{{ old('name', @$product->name) }}" required />

    <x-wire-textarea label="{{ __('Description') }}" name="description"
        placeholder="{{ __('Please insert this information: :name', ['name' => __('Description')]) }}">{{ old('description', @$product->description) }}</x-wire-textarea>

    <x-wire-input label="{{ __('Price') }}" name="price"
        placeholder="{{ __('Please insert this information: :name', ['name' => __('Price')]) }}"
        value="{{ old('price', @$product->price) }}" required />

    <x-wire-native-select label="{{ __('Category') }}" name="category_id" required>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', @$product->category_id) == $category->id)>{{ $category->name }}</option>
        @endforeach
    </x-wire-native-select>
</div>
