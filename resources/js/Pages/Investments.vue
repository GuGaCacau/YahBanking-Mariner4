<script setup>
    import { Link } from '@inertiajs/vue3'
    import TheHeader from '@/Components/TheHeader.vue'
    import Table from '@/Components/Table.vue'
    import TheFooter from '@/Components/TheFooter.vue'
    import { PencilSquareIcon, MagnifyingGlassIcon , TrashIcon} from '@heroicons/vue/24/solid'

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

    const navbar = {
        clients : {'opacity-60': true, 'hover:opacity-100': true},
        investments : {'font-bold':true}
    }

</script>

<template>
    <TheHeader :navbar="navbar"/>
    <Table :items="investments" :fields="fields">

        <template v-slot:item="data">
            <td class="text-center py-6">
                {{data.item}}
            </td>
        </template>

        <template v-slot:button="data">
            <td class="text-center">
                <Link href="#">
                    <button v-if="data.item == 'update'" class="bg-transparent hover:bg-cyan-500 text-gray-400 font-semibold hover:text-white py-2 px-2 border border-cyan-500 border-opacity-25 rounded">
                        <PencilSquareIcon class="h-4 w-4"/>
                    </button>
                    <button v-else-if="data.item == 'show'" class="bg-transparent hover:bg-cyan-500 text-green-500 font-semibold hover:text-white py-2 px-2 border border-cyan-500 border-opacity-25 rounded">
                        <MagnifyingGlassIcon class="h-4 w-4"/>
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
