<script setup>
    import TheHeader from '../Components/Main/TheHeader.vue'
    import DataTable from '../Components/Main/DataTable.vue'
    import TheFooter from '../Components/Main/TheFooter.vue'

    const props = defineProps({
        clients: Object
    })

    const table_head = [
    "Avatar",
    "Nome",
    "Sobrenome",
    "Email",
    "Valor Total",
    "Valor Investido",
    "Valor Não Investido",
    "Editar",
    "Investimento",
    "Deletar",
    ];
    
</script>

<template>
    <TheHeader />
    <DataTable :clients="clients" :table_head="table_head" />
    <TheFooter />
</template>

<style>

</style>
