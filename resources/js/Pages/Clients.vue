<script setup>
    import { Head, Link, router } from '@inertiajs/vue3'
    import TheHeader from '@/Layouts/TheHeader.vue'
    import Table from '@/Components/Table.vue'
    import TheFooter from '@/Layouts/TheFooter.vue'
    import { PencilSquareIcon, BanknotesIcon, TrashIcon } from '@heroicons/vue/24/solid'
    import SuccessMessage from '@/Components/Messages/SuccessMessage.vue'
    import TableHeader from '@/Components/Headers/TableHeader.vue'


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

    const destroy = (id) => {
        if (confirm('Tem certeza que deseja excluir esse cliente?')) {
            router.delete(route('client.destroy', id));
        }
    };

</script>

<template>
    <Head title="Clientes"/>

    <TheHeader />
    <SuccessMessage v-if="$page.props.flash.message"
        :message="$page.props.flash.message"
        />
    <TableHeader dataType="cliente"
        routeName="client.create"
        />
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
                <button v-if="data.item.field == 'update'" class="bg-transparent hover:bg-cyan-500 text-gray-400 font-semibold hover:text-white py-2 px-2 border border-cyan-500 border-opacity-25 rounded">
                    <PencilSquareIcon class="h-4 w-4"/>
                </button>
                <button v-else-if="data.item.field == 'investment'" class="bg-transparent hover:bg-cyan-500 text-green-500 font-semibold hover:text-white py-2 px-2 border border-cyan-500 border-opacity-25 rounded">
                    <BanknotesIcon class="h-4 w-4"/>
                </button>
                <button v-else @click="destroy(data.item.item.id)" class="bg-transparent hover:bg-cyan-500 text-red-600 font-semibold hover:text-white py-2 px-2 border border-cyan-500 border-opacity-25 rounded">
                    <TrashIcon class="h-4 w-4"/>
                </button>
            </td>
        </template>

    </Table>
    <TheFooter />
</template>

<style>

</style>
