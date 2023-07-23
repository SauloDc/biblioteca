<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    status: true,
});

const submit = () => {
    form.post(route('generos.store'));
};

</script>

<template>
    <Head title="Novo Gênero" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Novo Genero de Livro</h2>
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
                        <div class="relative flex items-start mt-3">
                            <div class="flex h-6 items-center">
                                <input id="status" type="checkbox" v-model="form.status"
                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                            </div>
                            <div class="ml-3 text-sm leading-6">
                                <label for="status" class="font-medium text-gray-900">Ativo?</label>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="button" @click="submit()"
                                class="rounded bg-blue-600 px-2 py-1 text-xs font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                                Criar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
