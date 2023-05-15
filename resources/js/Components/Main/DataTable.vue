<script setup>
    import { Link } from '@inertiajs/vue3'
    import { PencilSquareIcon, BanknotesIcon, TrashIcon, MagnifyingGlassIcon } from '@heroicons/vue/24/solid'

    const props = defineProps({
        clients: {
            type: Object,
            default: null
        },
        investments: {
            type: Object,
            default: null
        },
        table_head: {
            type: Array,
            required: true
        },
    })

</script>

<template>
  <div v-if="props.clients" class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <caption class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
            Lista de Clientes
            <br>  
            <Link class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400 hover:text-cyan-500">+ Adicionar novo cliente</Link>
      </caption>
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-900 dark:text-gray-400">
        <tr>
          <th v-for="item in table_head" scope="col" class="text-center px-6 py-3">{{item}}</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="client in props.clients" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
          <td class="flex justify-center items-center">
            <img class="rounded-full" alt="Avatar" style="height:60px;width:60px;" :src="client.avatar">
          </td>
          <td scope="row" class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">{{client.first_name}}</td>
          <td class="text-center">{{client.last_name}}</td>
          <td class="text-center">{{client.email}}</td>
          <td class="text-center">R$ {{(client.uninvested_amount + client.invested_amount).toFixed(2)}}</td>
          <td class="text-center">R$ {{(client.invested_amount).toFixed(2)}}</td>
          <td class="text-center">R$ {{(client.uninvested_amount).toFixed(2)}}</td>
          <td class="text-center">
            <Link href="#">
              <button class="bg-transparent hover:bg-cyan-500 text-gray-400 font-semibold hover:text-white py-2 px-2 border border-cyan-500 border-opacity-25 rounded">
                <PencilSquareIcon class="h-4 w-4"/>
              </button>
            </Link>
          </td>
          <td class="text-center">
            <Link href="#">
              <button class="bg-transparent hover:bg-cyan-500 text-green-500 font-semibold hover:text-white py-2 px-2 border border-cyan-500 border-opacity-25 rounded">
                <BanknotesIcon class="h-4 w-4"/>
              </button>
            </Link>
          </td>  
          <td class="text-center">
            <Link href="#">
              <button class="bg-transparent hover:bg-cyan-500 text-red-600 font-semibold hover:text-white py-2 px-2 border border-cyan-500 border-opacity-25 rounded">
                <TrashIcon class="h-4 w-4"/>   
              </button>
            </Link>
          </td>    
        </tr>
      </tbody>
    </table>
  </div>
  <div v-else>
    <div class="relative overflow-x-auto">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <caption class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
              Lista de Investimentos
              <br>  
              <Link class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400 hover:text-cyan-500">+ Adicionar novo investimento</Link>
        </caption>
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-900 dark:text-gray-400">
          <tr>
            <th v-for="item in table_head" scope="col" class="text-center px-6 py-3">{{item}}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="investment in props.investments" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
            <td scope="row" class="text-center py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{investment.commercial_name}}</td>
            <td class="text-center py-3">{{investment.commercial_sail}}</td>
            <td class="text-center py-3">
              <Link href="#">
                <button class="bg-transparent hover:bg-cyan-500 text-gray-400 font-semibold hover:text-white py-2 px-2 border border-cyan-500 border-opacity-25 rounded">
                  <PencilSquareIcon class="h-4 w-4"/>
                </button>
              </Link>
            </td>
            <td class="text-center py-3">
              <Link href="#">
                <button class="bg-transparent hover:bg-cyan-500 text-grey-500 font-semibold hover:text-white py-2 px-2 border border-cyan-500 border-opacity-25 rounded">
                  <MagnifyingGlassIcon class="h-4 w-4"/>
                </button>
              </Link>
            </td>  
            <td class="text-center py-3">
              <Link href="#">
                <button class="bg-transparent hover:bg-cyan-500 text-red-600 font-semibold hover:text-white py-2 px-2 border border-cyan-500 border-opacity-25 rounded">
                  <TrashIcon class="h-4 w-4"/>   
                </button>
              </Link>
            </td>    
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<style>

</style>