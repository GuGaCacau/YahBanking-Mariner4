<script setup>
defineProps({
    value: {
        type: String,
    },
    forValue: {
        type: String,
    },
});
</script>

<template>
    <label :for="forValue" class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
