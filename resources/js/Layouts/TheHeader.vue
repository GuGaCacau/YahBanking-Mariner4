<script setup>
    import { Link } from '@inertiajs/vue3'
    import { ref } from 'vue';
    import DropdownLink from '@/Components/DropdownLink.vue';

    const showingNavigationDropdown = ref(false);

</script>

<template>
  <nav class="flex items-center justify-between flex-wrap bg-gray-900 p-6">

    <!-- Logo da aplicação -->
    <div class="flex items-center flex-shrink-0 text-white mr-6">
      <Link :href="route('index')">
        <span class="font-semibold text-orange-500 text-xl tracking-tight">Yahbanking</span>
        <span class="font-semibold text-cyan-500 text-xl tracking-tight"> Mariner4</span>
      </Link>
    </div>

    <!-- Links principais da aplicação -->
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <Link :href="route('index')" :class="{ 'font-bold text-cyan-500': $page.component === 'Clients', 'opacity-60 text-white hover:text-cyan-500 hover:opacity-100': $page.component != 'Clients'}">
            Clientes
        </Link>
        <Link :href="route('investments')" :class="{ 'font-bold text-cyan-500': $page.component === 'Investments', 'opacity-60 text-white hover:text-cyan-500 hover:opacity-100': $page.component != 'Investments'}">
            Investimentos
        </Link>
    </div>

    <!-- Hamburger -->
    <div class="-mr-2 flex items-center sm:hidden">
        <button @click="showingNavigationDropdown = !showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md bg-gray-800 text-gray-400 hover:text-orange-500 focus:outline-none focus:bg-gray-800 focus:text-orange-500 transition duration-150 ease-in-out">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path
                    :class="{
                        hidden: showingNavigationDropdown,
                        'inline-flex': !showingNavigationDropdown,
                    }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                />
                <path
                    :class="{
                        hidden: !showingNavigationDropdown,
                        'inline-flex': showingNavigationDropdown,
                    }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                />
            </svg>
        </button>
    </div>

    <!-- Links do Hamburger-->
    <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <DropdownLink :href="route('index')" class="rounded hover:bg-gray-800" :class="{ 'font-bold text-white': $page.component === 'Clients', 'opacity-60 text-white hover:text-cyan-500 hover:opacity-100': $page.component != 'Clients'}">
                Clientes
            </DropdownLink>
            <DropdownLink :href="route('investments')" class="rounded hover:bg-gray-800" :class="{ 'font-bold text-white': $page.component === 'Investments', 'opacity-60 text-white hover:text-cyan-500 hover:opacity-100': $page.component != 'Investments'}">
                Investimentos
            </DropdownLink>
        </div>
    </div>

  </nav>
</template>

<style>

</style>
