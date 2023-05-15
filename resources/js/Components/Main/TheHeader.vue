<script setup>
    import { Link } from '@inertiajs/vue3'

</script>

<template>
  <nav class="flex items-center justify-between flex-wrap bg-gray-900 p-6">
    <div class="flex items-center flex-shrink-0 text-white mr-6">
      <Link :href="route('index')">
        <span class="font-semibold text-orange-500 text-xl tracking-tight">Yahbanking</span>
        <span class="font-semibold text-cyan-500 text-xl tracking-tight"> Mariner4</span>
      </Link>
    </div>
    <div class="block lg:hidden">
      <button class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
        <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
      </button>
    </div>
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
        <ul class="flex">
          <li class="mr-6">
            <Link class="text-white hover:text-cyan-500" :href="route('index')">Clientes</Link>
          </li>
          <li class="mr-6">
            <Link class="text-white opacity-60   hover:text-cyan-500 hover:opacity-100" :href="route('investments')">Investimentos</Link>
          </li>
        </ul>
    </div>
  </nav>
</template>

<style>

</style>