<x-forms.actions-buttons :model="$product" :edit-route="route('admin.products.edit', $product)" :destroy-route="route('admin.products.destroy', $product)" :title-name="$product->name" />
