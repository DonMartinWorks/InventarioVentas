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
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
                <div class="grid lg:grid-cols-2 gap-4">
                    {{-- Series --}}
                    <x-wire-input label="{{ __('Series') }}" wire:model="series" disabled></x-wire-input>

                    {{-- Correlative --}}
                    <x-wire-input label="{{ __('Correlative') }}" wire:model="correlative" disabled></x-wire-input>
                </div>

                {{-- Date --}}
                <x-wire-input type="date" label="{{ __('Date') }}" wire:model="date"></x-wire-input>

                {{-- Origin Warehouse --}}
                <x-wire-select label="{{ __('Origin Warehouse') }}" wire:model.live="origin_warehouse_id" :async-data="[
                    'api' => route('api.warehouses.index'),
                    'method' => 'POST',
                ]"
                    option-label="name" option-value="id" required />

                {{-- Destination Warehouse --}}
                <x-wire-select label="{{ __('Destination Warehouse') }}" wire:model="destination_warehouse_id"
                    :async-data="[
                        'api' => route('api.warehouses.index'),
                        'method' => 'POST',
                        'params' => [
                            'exclude' => $this->origin_warehouse_id,
                        ],
                    ]" option-label="name" option-value="id" required />
            </div>

            <div class="lg:flex lg:space-x-4">
                {{-- Product --}}
                <x-wire-select label="{{ __('Product') }}" wire:model="product_id" :async-data="[
                    'api' => route('api.products.index'),
                    'method' => 'POST',
                ]" option-label="name"
                    option-value="id" class="flex-1" required />

                <div class="flex shrink-0">
                    <x-wire-button wire:click="addProduct" spinner="addProduct" class="w-full lg:mt-6.5 mt-4" light gray
                        label="{{ __('Save') }}" right-icon="check" flat interaction:solid="positive" />
                </div>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto w-full">
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
                                    <x-wire-input x-model="product.quantity" type="number" class="w-20"
                                        min="0" />
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
            </div>

            {{-- Total --}}
            <section class="flex items-center space-x-4 mt-6">
                <x-label for="observation">{{ __('Observations') }}</x-label>
                <x-wire-textarea class="flex-1" id="observation" wire:model="observation" />

                <div>
                    {{ __('Total') }}&#58;&#160;&#36;<span x-text="total.toFixed(2)"
                        class="text-semibold text-gray-600 text-xl"></span>
                </div>
            </section>

            <div class="flex justify-end py-4">
                <x-wire-button type="submit" right-icon="check" outline secondary interaction:solid="positive"
                    spinner="save" label="{{ __('Save') }}" rounded="lg" />
            </div>
        </form>
    </x-wire-card>
</div>
