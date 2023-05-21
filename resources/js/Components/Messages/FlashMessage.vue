<script setup>

const props = defineProps({
    message: {
        type: String,
    },
    colorValue: {
        type: String,
    }
});

</script>

<template>
    <div :class="`p-2 font-bold text-${colorValue}`">
        {{ message }}
    </div>
</template>
