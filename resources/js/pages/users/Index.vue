<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, usePage, router } from '@inertiajs/vue3';
import type {  BreadcrumbItem,  PageNumber,  UsersPageProps } from '@/types';
import { onMounted } from 'vue';
import { useUserStore } from '@/stores/userStore';
import { useAuthStore } from '@/stores/authStore';

const auth = useAuthStore();

auth.guard();


const breadcrumbItems: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/' },
    { title: 'Users', href: '/users' },
];

// const page = usePage();
const userStore = useUserStore();
onMounted(() => {
  userStore.fetchUsers()
})
function goTo(page: number) {
    userStore.fetchUsers(page)
}
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="User List" />

        <div class="p-4">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-xl font-bold">User List</h1>
            </div>
            <table class="w-full border-collapse rounded-lg overflow-hidden shadow-lg dark:shadow-none">
            <!-- Table Header -->
            <thead>
                <tr class="bg-gray-900 text-white font-bold uppercase">
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">First Name</th>
                    <th class="p-3 text-left">Middle Name</th>
                    <th class="p-3 text-left">Last Name</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Created At</th>
                </tr>
            </thead>

            <!-- Table Body -->
            <tbody>
                <tr
                    v-for="(user, index) in userStore.users"
                    :key="user.id"
                    :class="index % 2 === 0 
                        ? 'bg-gray-900 dark:bg-gray-800' 
                        : 'bg-gray-700 dark:bg-gray-700'"
                    class="hover:bg-gray-500 dark:hover:bg-gray-600 transition-colors duration-200"
                >
                    <td class="p-3 text-white">{{ user.id }}</td>
                    <td class="p-3 text-white">{{ user.first_name }}</td>
                    <td class="p-3 text-white">{{ user.middle_name }}</td>
                    <td class="p-3 text-white">{{ user.last_name }}</td>
                    <td class="p-3 text-white">{{ user.email }}</td>
                    <td class="p-3 text-white">{{ new Date(user.created_at).toLocaleDateString() }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="flex gap-2 mt-4 justify-center">
            <button
                v-for="link in userStore.pagination.links"
                :key="link.label"
                :disabled="!link.url"
                @click="link.url && goTo(Number(link.url.split('page=')[1] ?? 1))"
                v-html="link.label"
                class="px-3 py-1 border rounded bg-gray-700 text-white hover:bg-gray-600 disabled:opacity-50 transition-colors"
            />
        </div>

        </div>
    </AppLayout>
</template>
