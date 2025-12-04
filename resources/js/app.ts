import '../css/app.css';

import { createInertiaApp, router } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { DefineComponent } from 'vue';
import { createApp, h } from 'vue';
import { initializeTheme } from './composables/useAppearance';
import { createPinia } from 'pinia';
import piniaPersistedstate from 'pinia-plugin-persistedstate';
// import { createRouter, createWebHistory } from 'vue-router';

// const routes = [
//     { path: '/', component: () => import('./pages/Welcome.vue') },
//     { path: '/login', component: () => import('./pages/auth/Login.vue') },
//     { path: '/dashboard', component: () => import('./pages/Dashboard.vue') }
// ]

// const router = createRouter({
//     history: createWebHistory(),
//     routes,
// })



const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
const pinia = createPinia();
pinia.use(piniaPersistedstate)
createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    resolve: (name) =>
        resolvePageComponent(
            `./pages/${name}.vue`,
            import.meta.glob<DefineComponent>('./pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(pinia)
            // .use(router)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

// This will set light / dark mode on page load...
initializeTheme();
