<script setup>
    import TheHeader from '../Components/Main/TheHeader.vue'
    import DataTable from '../Components/Main/DataTable.vue'
    import TheFooter from '../Components/Main/TheFooter.vue'

    const props = defineProps({
        investments: Object
    })

    const table_head = [
    "Nome",
    "Sigla",
    "Editar",
    "Visualizar",
    "Encerrar",
    ];
    
</script>

<template>
    <TheHeader />
    <DataTable :investments="investments" :table_head="table_head" />
    <TheFooter />
</template>

<style>

</style>
