<!-- Description -->
<div class="mt-4">
    <x-input-label for="description" :value="__('Description')" />

    <textarea name="description" id="description"></textarea>

    <x-input-error :messages="$errors->get('description')" class="mt-2" />
</div>