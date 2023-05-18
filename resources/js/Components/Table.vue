<script setup>
  import { Link } from '@inertiajs/vue3'

  const props = defineProps({
    items: {
        type: Object,
        default: null
    },
    fields: {
        type: Object,
        required: true
    }
  });

</script>

<template>
  <div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-900 dark:text-gray-400">
        <tr>
            <th v-for="field in fields" :key="field.id" scope="col" class="text-center px-6 py-3">
                {{field.head}}
            </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in items" :key="item.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">

            <slot v-for="field in fields" :key="field.id" :name="field.type"
                :item="field.column == 'total_amount' ? (item.invested_amount + item.uninvested_amount)
                : field.type == 'button' ? field.column
                : item[field.column]" />

        </tr>
      </tbody>
    </table>
  </div>
</template>

<style>

</style>
