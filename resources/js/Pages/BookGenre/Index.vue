<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { format, parseISO } from 'date-fns'

const props = defineProps({
    bookGenres: Object,
});

const deletar = (id) => {
    if (confirm('Deseja realmente deletar este registro?')) {
        router.delete(route('generos.destroy', id));
    }
};

const toggleStatus = (genero) => {
    if (confirm('Deseja realmente alterar o status deste registro? ' + genero.name)) {
        router.put(route('generos.toggle-status', genero.id));
    }
};

</script>

<template>
    <Head title="Generos" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Generos dos Livros</h2>
                <Link :href="route('generos.create')"
                    class="rounded bg-green-600 px-2 py-1 text-xs font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
                + Novo Genero
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        <!-- table -->
                        <div class="flex flex-col">
                            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                    <div class="overflow-hidden">
                                        <table class="w-full text-left text-sm font-light">
                                            <thead class="border-b font-medium dark:border-neutral-500">
                                                <tr>
                                                    <th scope="col" class="px-6 py-4">#</th>
                                                    <th scope="col" class="px-6 py-4">Nome</th>
                                                    <th scope="col" class="px-6 py-4">Status</th>
                                                    <th scope="col" class="px-6 py-4">Data de Criação</th>
                                                    <th scope="col" class="px-6 py-4">Última Atualização</th>
                                                    <th scope="col" class="px-6 py-4">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <template v-if="bookGenres.data.length > 0">
                                                    <tr v-for="genero in bookGenres.data" :key="genero.id"
                                                        class="border-b dark:border-neutral-500">
                                                        <td class="whitespace-nowrap px-6 py-4 font-medium">{{ genero.id }}
                                                        </td>
                                                        <td class="whitespace-nowrap px-6 py-4">{{ genero.name }}</td>
                                                        <td class="whitespace-nowrap px-6 py-4">
                                                            <span v-if="genero.status"
                                                                class="inline-flex items-center rounded-md bg-green-100 px-2 py-1 text-xs font-medium text-green-700">
                                                                Ativo
                                                            </span>
                                                            <span v-else
                                                                class="inline-flex items-center rounded-md bg-red-100 px-2 py-1 text-xs font-medium text-red-700">
                                                                Inativo
                                                            </span>
                                                        </td>
                                                        <td class="whitespace-nowrap px-6 py-4">
                                                            {{
                                                                format(parseISO(genero.created_at), "dd/MM/yyy 'às' HH:mm'h'")
                                                            }}
                                                        </td>
                                                        <td class="whitespace-nowrap px-6 py-4">
                                                            {{
                                                                format(parseISO(genero.updated_at), "dd/MM/yyy 'às' HH:mm'h'")
                                                            }}
                                                        </td>
                                                        <td class="whitespace-nowrap px-6 py-4">
                                                            <div class="flex justify-evenly">
                                                                <button type="button" @click="toggleStatus(genero)"
                                                                    class="rounded bg-blue-600 px-2 py-1 text-xs font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                                                                    ativar/desativar
                                                                </button>

                                                                <Link :href="route('generos.edit', genero.id)"
                                                                    class="rounded bg-yellow-600 px-2 py-1 text-xs font-semibold text-white shadow-sm hover:bg-yellow-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-yellow-600">
                                                                Editar
                                                                </Link>

                                                                <button type="button" @click="deletar(genero.id)"
                                                                    class="rounded bg-red-600 px-2 py-1 text-xs font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                                                                    Deletar
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </template>
                                                <template v-else>
                                                    <tr>
                                                        <td colspan="6" class="text-center py-4">
                                                            Nenhum registro encontrado
                                                        </td>
                                                    </tr>
                                                </template>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
