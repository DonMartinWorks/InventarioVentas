<x-forms.actions-buttons :model="$supplier" :edit-route="route('admin.suppliers.edit', $supplier)" :destroy-route="route('admin.suppliers.destroy', $supplier)" :title-name="$supplier->name" />
