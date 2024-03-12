<script setup>
const {
    inputId,
    isError,
    oldValue,
    placeholder,
    type,
    autocompleteValue,
    name,
    id,
} = defineProps([
    "inputId",
    "isError",
    "oldValue",
    "placeholder",
    "type",
    "autocompleteValue",
    "name",
    "id",
]);
</script>

<template>
    <input
        :id="id || inputId"
        :type="type"
        :class="isError && 'is-invalid'"
        :name="name || inputId"
        :value="oldValue"
        :placeholder="placeholder"
        required
        :autocomplete="autocompleteValue || inputId"
        autofocus
    />
</template>

<style scoped lang="scss">
@import "../../sass/variables";

input {
    border-radius: 10px;
    border: none;
    padding: 10px 15px;
    font-size: 14px;
    font-weight: 700;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    background: rgba(79, 31, 207, 0.12);
    color: $secondary;

    &::placeholder {
        color: $secondary;
    }
}
</style>
