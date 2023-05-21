<script setup>

defineProps({
    modelValue: {
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
    <input
        type="file"
        class="text-gray-400"
        accept="image/*"
        :id="id"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.files[0])"
    />
</template>
