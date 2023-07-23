<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { format, parseISO } from 'date-fns'


const props = defineProps({
    autor: Object,
});

const form = useForm({
    name: props.autor.name,
    birth_date: format(parseISO(props.autor.birth_date), 'yyyy-MM-dd'),
});

const submit = () => {
    form.put(route('autores.update', props.autor.id));
};

</script>

<template>
    <Head title="Editar Autor" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Autor</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div>
                            <label for="nome" class="block text-sm font-medium leading-6 text-gray-900">Nome</label>
                            <div class="mt-2">
                                <input type="text" id="nome" v-model="form.name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    placeholder="Nome do Genero" />
                            </div>
                            <span v-if="form.errors.name" class="text-red-500 text-xs italic mt-2">
                                {{ form.errors.name }}
                            </span>
                        </div>
                        <div class="mt-2">
                            <label for="birth_date" class="block text-sm font-medium leading-6 text-gray-900">
                                Data de Nascimentos
                            </label>
                            <div class="mt-2">
                                <input type="date" id="birth_date" v-model="form.birth_date"
                                    :max="format(new Date, 'yyyy-MM-d')"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            </div>
                            <span v-if="form.errors.birth_date" class="text-red-500 text-xs italic mt-2">
                                {{ form.errors.birth_date }}
                            </span>
                        </div>
                        <div class="flex justify-end mt-5">
                            <button type="button" @click="submit()"
                                class="rounded bg-yellow-600 px-2 py-1 text-xs font-semibold text-white shadow-sm hover:bg-yellow-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-yellow-600">
                                Editar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
