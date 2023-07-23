<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { format, parseISO } from 'date-fns'

const props = defineProps({
    bookAuthors: Object,
});

const deletar = (id) => {
    if (confirm('Deseja realmente deletar este registro?')) {
        router.delete(route('autores.destroy', id));
    }
};

</script>

<template>
    <Head title="Autores" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Autores</h2>
                <Link :href="route('autores.create')"
                    class="rounded bg-green-600 px-2 py-1 text-xs font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
                + Novo Autor
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
                                                    <th scope="col" class="px-6 py-4">Data de Nacimento</th>
                                                    <th scope="col" class="px-6 py-4">Última Atualização</th>
                                                    <th scope="col" class="px-6 py-4">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <template v-if="bookAuthors.data.length > 0">
                                                    <tr v-for="autor in bookAuthors.data" :key="autor.id"
                                                        class="border-b dark:border-neutral-500">
                                                        <td class="whitespace-nowrap px-6 py-4 font-medium">{{ autor.id }}
                                                        </td>
                                                        <td class="whitespace-nowrap px-6 py-4">{{ autor.name }}</td>
                                                        <td class="whitespace-nowrap px-6 py-4">
                                                            {{
                                                                format(parseISO(autor.birth_date), "dd/MM/yyy")
                                                            }}
                                                        </td>
                                                        <td class="whitespace-nowrap px-6 py-4">
                                                            {{
                                                                format(parseISO(autor.updated_at), "dd/MM/yyy 'às' HH:mm'h'")
                                                            }}
                                                        </td>
                                                        <td class="whitespace-nowrap px-6 py-4">
                                                            <div class="flex justify-evenly">
                                                                <Link :href="route('autores.edit', autor.id)"
                                                                    class="rounded bg-yellow-600 px-2 py-1 text-xs font-semibold text-white shadow-sm hover:bg-yellow-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-yellow-600">
                                                                Editar
                                                                </Link>

                                                                <button type="button" @click="deletar(autor.id)"
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
