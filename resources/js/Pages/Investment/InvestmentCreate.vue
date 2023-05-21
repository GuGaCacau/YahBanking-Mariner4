<script setup>
    import { Head, useForm, router } from '@inertiajs/vue3'
    import TheHeader from '@/Layouts/TheHeader.vue'
    import InvestmentForm from '@/Components/Forms/InvestmentForm.vue'
    import TheFooter from '@/Layouts/TheFooter.vue'

    const props = defineProps({
        errors: {
            type: Object,
            default: () => ({})
        }
    });

    const form = useForm({
        commercial_name: '',
        commercial_sail: '',
        description: '',
    });

    function submit() {
        router.post(route('investment.store'), form)
    }

</script>

<template>
    <Head title="Cadastro - Investimentos"/>

    <TheHeader />
    <div>
        <p class="flex justify-center tracking-wide text-gray-300 text-xl mt-4 mb-4 font-bold">Cadastro de Investimento</p>
        <div class="flex justify-center">
            <form @submit.prevent="submit" class="w-full max-w-lg">
            <InvestmentForm :form="form" :errors="errors" />
            <button
                class="inline-flex items-center px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-cyan-500 active:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition ease-in-out duration-150"
                type="submit"
                :disabled="form.processing"
                >
                Cadastrar
            </button>
            </form>
        </div>
    </div>
    <TheFooter />
</template>

<style>

</style>
