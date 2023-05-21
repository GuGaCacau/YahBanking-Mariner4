<script setup>
    import { Link } from '@inertiajs/vue3'

    const props = defineProps({
        dataType: {
            type: String,
        },
        routeName: {
            type: String,
        }
    })

</script>

<template>
    <caption class="w-full p-4 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
            Lista de {{ dataType }}s
            <br>
            <Link :href="route(routeName)" class="text-sm font-normal text-gray-500 dark:text-gray-400 hover:text-cyan-500">+ Adicionar novo {{ dataType }}</Link>
    </caption>
</template>
