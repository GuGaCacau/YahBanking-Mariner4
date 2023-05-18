<script setup>
    import { Link } from '@inertiajs/vue3'
    import TheHeader from '@/Components/TheHeader.vue'
    import TheFooter from '@/Components/TheFooter.vue'

    const navbar = {
        clients : {'opacity-60':true, 'hover:opacity-100':true},
        investments : {'opacity-60':true, 'hover:opacity-100':true}
    }

</script>

<template>
    <TheHeader :navbar="navbar"/>

    <TheFooter />
</template>

<style>

</style>
