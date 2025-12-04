import { defineStore } from 'pinia'
import axios from 'axios'
import { useAuthStore } from './authStore'
import type { User, Pagination } from '@/types'

type UserListResponse = {
    data: User[]
} & Pagination

export const useUserStore = defineStore('user', {
    state: () => ({
        users: [] as User[],
        pagination: {
            current_page: 1,
            last_page: 1,
            per_page: 10,
            total: 0,
            links: [],
        } as Pagination,
        loading: false as boolean,
    }),

    actions: {
        setUsers(payload: UserListResponse) {
            this.users = payload.data

            // strip "data" and store only pagination fields
            const { data, ...paginationInfo } = payload
            this.pagination = paginationInfo
        },

        async fetchUsers(page = 1) {
            this.loading = true
            try {
                // const res = await axios.get(`/api/v1/users?page=${page}`)
                const authStore = useAuthStore()
                const res = await fetch(`/api/v1/users?page=${page}`, {
                    headers: {
                        Authorization: `Bearer ${authStore.token}`,
                        Accept: "application/json",
                    },
                });

                const data = await res.json();

                // if (!res.ok) throw data;

                // this.user = data;
                // return data;
                this.setUsers(data)
            } finally {
                this.loading = false
            }
        },

        async deleteUser(id: number) {
            await axios.delete(`/api/users/${id}`)
            this.users = this.users.filter(u => u.id !== id)
        }
    },
})