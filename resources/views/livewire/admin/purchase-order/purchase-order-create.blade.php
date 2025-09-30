<div x-data="{
    products: @entangle('products'),
    total: @entangle('total'),

    removeProduct(index) {
        this.products.splice(index, 1);
    },

    init() {
        this.$watch('products', (newProducts) => {
            let total = 0;

            newProducts.forEach(product => {
                total += product.quantity * product.price;
            });

            this.total = total;
        });
    }
}">
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
            </div>

            {{-- Supplier --}}
            <x-wire-select label="{{ __('Supplier') }}" wire:model="supplier_id" :async-data="[
                'api' => route('api.suppliers.index'),
                'method' => 'POST',
            ]" option-label="name"
                option-value="id" class="flex-1" />

            <div class="flex space-x-4">
                {{-- Product --}}
                <x-wire-select label="{{ __('Product') }}" wire:model="product_id" :async-data="[
                    'api' => route('api.products.index'),
                    'method' => 'POST',
                ]" option-label="name"
                    option-value="id" class="flex-1" />

                <div class="flex shrink-0">
                    <x-wire-button wire:click="addProduct" class="mt-6.5" light gray label="{{ __('Save') }}"
                        right-icon="check" flat interaction:solid="positive" />
                </div>
            </div>

            {{-- Table --}}
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="text-gray-700 border-y bg-blue-50">
                        <th class="py-2 px-4">{{ __('Product') }}</th>
                        <th class="py-2 px-4">{{ __('Quantity') }}</th>
                        <th class="py-2 px-4">{{ __('Price') }}</th>
                        <th class="py-2 px-4">{{ __('Subtotal') }}</th>
                        <th class="py-2 px-4"></th>
                    </tr>
                </thead>

                <tbody>
                    <template x-for="(product, index) in products" :key="product.id">
                        <tr class="border-b">
                            <td class="px-4 py-1" x-text="product.name"></td>

                            <td class="px-4 py-1">
                                <x-wire-input x-model="product.quantity" type="number" class="w-20" min="0" />
                            </td>

                            <td class="px-4 py-1">
                                <x-wire-input x-model="product.price" type="number" class="w-36" step="0.01"
                                    min="0" />
                            </td>

                            <td class="px-4 py-1" x-text="(product.quantity * product.price).toFixed(2)"></td>

                            <td class="px-4 py-1">
                                <x-wire-mini-button x-on:click="removeProduct(index)" rounded outline icon="trash"
                                    negative />
                            </td>
                        </tr>
                    </template>

                    <template x-if="products.length === 0">
                        <tr>
                            <td colspan="5" class="text-center text-gray-700 font-semibold py-4">
                                {{ __('There are no added products!') }}
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>

            {{-- Total --}}
            <section class="flex items-center space-x-4 mt-6">
                <x-label for="observation">{{ __('Observations') }}</x-label>
                <x-wire-textarea class="flex-1" id="observation" wire:model="observations" />

                <div>
                    {{ __('Total') }}&#58;&#160;&#36;<span x-text="total.toFixed(2)"
                        class="text-semibold text-gray-600 text-xl"></span>
                </div>
            </section>

            <div class="flex justify-end py-4">
                <x-wire-button type="submit" right-icon="check" outline secondary interaction:solid="positive"
                    label="{{ __('Save') }}" rounded="lg" />
            </div>
        </form>
    </x-wire-card>
</div>
