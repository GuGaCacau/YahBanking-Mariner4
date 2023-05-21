<script setup>

defineProps({
    modelValue: {
        type: String,
        required: true,
    },
    id: {
        type: String,
        required: true,
    }
});

defineEmits(['update:modelValue'])

</script>

<template>
    <textarea
        class="rounded-md appearance-none block w-full bg-gray-200 text-gray-700 border border-cyan-500 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
        type="text"
        rows="4"
        :id="id"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    />
</template>
