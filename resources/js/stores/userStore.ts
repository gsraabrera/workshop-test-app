import { defineStore } from 'pinia';
import { ref } from 'vue';
import type { User, Pagination } from '@/types';


export const useUserStore = defineStore('user', () => {
    const users = ref<User[]>([]);
    const pagination = ref({});

    function setUsers(payload: { data: User[] } & Pagination) {
        users.value = payload.data;
        pagination.value = payload;
    }

    return { users, pagination, setUsers };
});
