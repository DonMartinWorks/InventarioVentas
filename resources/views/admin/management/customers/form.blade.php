{{-- <x-wire-native-select label="{{ __('Category') }}" name="category_id" required>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', @$product->category_id) == $category->id)>{{ $category->name }}</option>
        @endforeach
    </x-wire-native-select>
 --}}

<div class="space-y-4 mb-8">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="col-span-1 md:col-span-2">
            <x-wire-native-select label="{{ __('Document Type') }}" name="identity_id" required>
                @foreach ($identities as $identity)
                    <option value="{{ $identity->id }}" @selected(old('identity_id', @$customer->identity_id) == $identity->id)>{{ $identity->name }}</option>
                @endforeach
            </x-wire-native-select>
        </div>

        <div class="col-span-1 md:col-span-2">
            <x-wire-input label="{{ __('Document Number') }}" name="document_number"
                placeholder="{{ __('Please insert this information: :name', ['name' => __('Document Number')]) }}"
                value="{{ old('document_number', @$customer->document_number) }}" required />
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="col-span-1 md:col-span-2">
            <x-wire-input label="{{ __('Name') }}" name="name"
                placeholder="{{ __('Please insert this information: :name', ['name' => __('Name')]) }}"
                value="{{ old('name', @$customer->name) }}" required />
        </div>

        <div class="col-span-1 md:col-span-2">
            <x-wire-input label="{{ __('Address') }}" name="address"
                placeholder="{{ __('Please insert this information: :name', ['name' => __('Address')]) }}"
                value="{{ old('address', @$customer->address) }}" />
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="col-span-1 md:col-span-2">
            <x-wire-input label="{{ __('Email') }}" name="email"
                placeholder="{{ __('Please insert this information: :name', ['name' => __('Email')]) }}"
                value="{{ old('email', @$customer->email) }}" />
        </div>

        <div class="col-span-1 md:col-span-2">
            <x-wire-input label="{{ __('Phone') }}" name="phone"
                placeholder="{{ __('Please insert this information: :name', ['name' => __('Phone')]) }}"
                value="{{ old('phone', @$customer->phone) }}" />
        </div>
    </div>
</div>
