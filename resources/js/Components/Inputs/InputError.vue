<script setup>

    const props = defineProps({
        error: {
            type: String,
        }
    });

</script>

<template>
    <span v-if="error" class="text-orange-500 mb-4">
        {{ error }}
    </span>
</template>
