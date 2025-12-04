import { defineStore } from "pinia";
import { router } from '@inertiajs/vue3'

export const useAuthStore = defineStore("auth", {
    state: () => ({
        user: null,
        token: localStorage.getItem("token") || null,
    }),

    actions: {
        setAuth(data: any) {
            this.user = data.user;
            this.token = data.token;
        },

        async register(form: {
            first_name: string;
            last_name: string;
            email: string;
            password: string;
            password_confirmation: string;
        }) {
            const res = await fetch("/api/v1/register", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
                body: JSON.stringify(form),
            });

            const data = await res.json();

            if (!res.ok) throw data;

            // Save token + user
            this.setAuth(data);

            return data;
        },

        async fetchUser() {
            const res = await fetch("/api/v1/user", {
                headers: {
                    Authorization: `Bearer ${this.token}`,
                    Accept: "application/json",
                },
                credentials: "include",
            });

            const data = await res.json();

            if (!res.ok) throw data;

            this.user = data;
            return data;
        },


        guard(redirectTo = '/login') {
            if (!this.token) {
                router.visit(redirectTo)
                return false
            }
            return true
        },

        // For login/register pages (guest-only)
        guestGuard(redirectTo = '/dashboard') {
            if (this.token) {
                router.visit(redirectTo)
                return false
            }
            return true
        },

        async login(form: { email: string; password: string }) {
            const res = await fetch('/api/v1/login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', Accept: 'application/json' },
                credentials: 'include',
                body: JSON.stringify(form),
            })
            const data = await res.json()

            if (!res.ok) throw data

            this.setAuth(data)
            return data
        },

        logout() {
            this.user = null
            this.token = null
            localStorage.removeItem('token')
        },
    },
    persist: true,
});
