<x-forms.actions-buttons :model="$warehouse" :edit-route="route('admin.warehouses.edit', $warehouse)" :destroy-route="route('admin.warehouses.destroy', $warehouse)" :title-name="$warehouse->name" />
