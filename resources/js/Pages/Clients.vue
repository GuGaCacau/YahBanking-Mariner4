<script setup>
    import { Link } from '@inertiajs/vue3'
    import TheHeader from '@/Components/TheHeader.vue'
    import Table from '@/Components/Table.vue'
    import TheFooter from '@/Components/TheFooter.vue'
    import { PencilSquareIcon, BanknotesIcon, TrashIcon } from '@heroicons/vue/24/solid'


    const props = defineProps({
        clients: Object
    })

    const fields = [
        { head:"Avatar", column:"avatar", type:"avatar", id:0 },
        { head:"Nome", column:"first_name", type:"item", id:1 },
        { head:"Sobrenome", column:"last_name", type:"item", id:2 },
        { head:"Email", column:"email", type:"item", id:3 },
        { head:"Valor Total", column:"total_amount", type:"value", id:4 },
        { head:"Valor Investido", column:"invested_amount", type:"value", id:5 },
        { head:"Valor Não Investido", column:"uninvested_amount", type:"value", id:6 },
        { head:"Editar", column:"update", type:"button", id:7 },
        { head:"Investimento", column:"investment", type:"button", id:8 },
        { head:"Deletar", column:"delete", type:"button", id:9 },
    ];

    const navbar = {
        clients : {'font-bold':true},
        investments : {'opacity-60':true, 'hover:opacity-100':true}
    }

</script>

<template>
    <TheHeader :navbar="navbar"/>
    <caption class="w-full p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
            Lista de Clientes
            <br>
            <Link :href="route('client.create')" class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400 hover:text-cyan-500">+ Adicionar novo cliente</Link>
    </caption>
    <Table :items="clients" :fields="fields">

        <template v-slot:avatar="data">
            <div class="flex justify-center items-center">
                <img class="rounded-full h-16 w-16 my-0.5" alt="Avatar" :src="data.item">
            </div>
        </template>

        <template v-slot:item="data">
            <td class="text-center">
                {{data.item}}
            </td>
        </template>

        <template v-slot:value="data">
            <td class="text-center">
                R$ {{(data.item).toFixed(2)}}
            </td>
        </template>

        <template v-slot:button="data">
            <td class="text-center">
                <Link href="#">
                    <button v-if="data.item == 'update'" class="bg-transparent hover:bg-cyan-500 text-gray-400 font-semibold hover:text-white py-2 px-2 border border-cyan-500 border-opacity-25 rounded">
                        <PencilSquareIcon class="h-4 w-4"/>
                    </button>
                    <button v-else-if="data.item == 'investment'" class="bg-transparent hover:bg-cyan-500 text-green-500 font-semibold hover:text-white py-2 px-2 border border-cyan-500 border-opacity-25 rounded">
                        <BanknotesIcon class="h-4 w-4"/>
                    </button>
                    <button v-else class="bg-transparent hover:bg-cyan-500 text-red-600 font-semibold hover:text-white py-2 px-2 border border-cyan-500 border-opacity-25 rounded">
                        <TrashIcon class="h-4 w-4"/>
                    </button>
                </Link>
            </td>
        </template>

    </Table>
    <TheFooter />
</template>

<style>

</style>
