<x-forms.actions-buttons :model="$customer" :edit-route="route('admin.customers.edit', $customer)" :destroy-route="route('admin.customers.destroy', $customer)" :title-name="$customer->name" />
