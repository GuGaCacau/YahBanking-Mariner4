<script setup>
    import InputLabel from '@/Components/Inputs/InputLabel.vue'
    import TextInput from '@/Components/Inputs/TextInput.vue'
    import TextAreaInput from '@/Components/Inputs/TextAreaInput.vue'
    import InputError from '@/Components/Inputs/InputError.vue';

    const props = defineProps({
        form: {
            type: Object,
            required: true
        },
        errors: {
            type: Object,
        },
    });

</script>

<template>
    <div class="flex flex-col mb-6 border-2 border-cyan-700 rounded-xl px-6 py-5">

            <InputLabel value="Nome Comercial" forValue="commercial_name"/>
            <TextInput
                id="commercial_name"
                v-model="form.commercial_name"
            />
            <InputError :error="errors.commercial_name"/>

            <InputLabel value="Sigla Comercial" forValue="commercial_sail"/>
            <TextInput
                id="commercial_sail"
                v-model="form.commercial_sail"
            />
            <InputError :error="errors.commercial_sail"/>

            <InputLabel value="Descrição" forValue="description"/>
            <TextAreaInput
                id="description"
                v-model="form.description"
            />
            <InputError :error="errors.description"/>

    </div>
</template>
