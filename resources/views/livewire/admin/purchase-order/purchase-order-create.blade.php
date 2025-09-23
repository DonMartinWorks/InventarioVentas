<div>
    <x-wire-card>
        <form wire:submit="save" class="space-y-4">
            <div class="grid grid-cols-4 gap-4">
                {{-- Voucher Type --}}
                <x-wire-native-select label="{{ __('Voucher Type') }}" wire:model="voucher_type">
                    <option value="" selected disabled>{{ __('Select') }}</option>
                    <option value="1">{{ __('Receipt') }}</option> {{-- Boleta --}}
                    <option value="2">{{ __('Invoice') }}</option> {{-- Factura --}}
                </x-wire-native-select>

                {{-- Series --}}
                <x-wire-input label="{{ __('Series') }}" wire:model="series" disabled></x-wire-input>

                {{-- Correlative --}}
                <x-wire-input label="{{ __('Correlative') }}" wire:model="correlative" disabled></x-wire-input>

                {{-- Date --}}
                <x-wire-input type="date" label="{{ __('Date') }}" wire:model="date"></x-wire-input>

                {{-- Supplier --}}
                <div class="col-span-1 md:col-span-2">
                    <x-wire-select label="{{ __('Supplier') }}" wire:model="supplier_id" :async-data="[
                        'api' => route('api.suppliers.index'),
                        'method' => 'POST',
                    ]"
                        option-label="name" option-value="id"></x-wire-select>
                </div>
            </div>
        </form>
    </x-wire-card>
</div>
