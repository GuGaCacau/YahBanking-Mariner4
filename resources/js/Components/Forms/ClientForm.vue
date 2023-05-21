<script setup>
    import InputLabel from '@/Components/Inputs/InputLabel.vue'
    import TextInput from '@/Components/Inputs/TextInput.vue'
    import ImageInput from '@/Components/Inputs/ImageInput.vue'
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

            <InputLabel value="Nome" forValue="first_name"/>
            <TextInput class="mb-4"
                id="first_name"
                v-model="form.first_name"
            />
            <InputError :error="errors.first_name"/>

            <InputLabel value="Sobrenome" forValue="last_name"/>
            <TextInput class="mb-4"
                id="last_name"
                v-model="form.last_name"
            />
            <InputError :error="errors.last_name"/>

            <InputLabel value="Email" forValue="email"/>
            <TextInput class="mb-4"
                id="email"
                v-model="form.email"
            />
            <InputError :error="errors.email"/>

            <InputLabel value="Avatar" forValue="avatar"/>
            <ImageInput class="mb-4"
                id="avatar"
                v-model="form.avatar"
            />
            <InputError :error="errors.avatar"/>
    </div>
</template>
