<script setup>
    import { Link, Head, router } from '@inertiajs/vue3'
    import TheHeader from '@/Layouts/TheHeader.vue'
    import Table from '@/Components/Table.vue'
    import TheFooter from '@/Layouts/TheFooter.vue'
    import { PencilSquareIcon, MagnifyingGlassIcon , TrashIcon} from '@heroicons/vue/24/solid'
    import SuccessMessage from '@/Components/Messages/SuccessMessage.vue'
    import TableHeader from '@/Components/Headers/TableHeader.vue'

    const props = defineProps({
        investments: Object
    })

    const fields = [
        { head:"Nome", column:"commercial_name", type:"item", id:0 },
        { head:"Sigla", column:"commercial_sail", type:"item", id:1 },
        { head:"Editar", column:"update", type:"button", id:2 },
        { head:"Visualizar", column:"show", type:"button", id:3 },
        { head:"Encerrar", column:"delete", type:"button", id:4 },
    ];

    const destroy = (id) => {
        if (confirm('Tem certeza que deseja excluir esse investimento?')) {
            router.delete(route('investment.destroy', id));
        }
    };

    const edit = (investment) => {

    }

</script>

<template>
    <Head title="Investimentos"/>

    <TheHeader />
    <SuccessMessage v-if="$page.props.flash.message"
        :message="$page.props.flash.message"
        />
    <TableHeader dataType="investimento"
        routeName="investment.create"
        />
    <Table :items="investments" :fields="fields">

        <template v-slot:item="data">
            <td class="text-center py-6">
                {{data.item}}
            </td>
        </template>

        <template v-slot:button="data">
            <td class="text-center">
                <button v-if="data.item.field == 'update'" @click.prevent="edit(data.item.item)" class="bg-transparent hover:bg-cyan-500 text-gray-400 font-semibold hover:text-white py-2 px-2 border border-cyan-500 border-opacity-25 rounded">
                    <PencilSquareIcon class="h-4 w-4"/>
                </button>
                <button v-else-if="data.item.field == 'show'" class="bg-transparent hover:bg-cyan-500 text-green-500 font-semibold hover:text-white py-2 px-2 border border-cyan-500 border-opacity-25 rounded">
                    <MagnifyingGlassIcon class="h-4 w-4"/>
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
