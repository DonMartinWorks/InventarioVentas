<x-forms.actions-buttons :model="$category" :edit-route="route('admin.categories.edit', $category)" :destroy-route="route('admin.categories.destroy', $category)" :title-name="$category->name" />
