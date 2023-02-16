import { createRouter, createWebHistory } from 'vue-router'
import routes from "@/Router/routes";
import {useAuthStore} from "@/Store/store";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
})

router.beforeEach((to, from) => {
    const authStore = useAuthStore()

    // if user has to be a guest, but user is logged in, redirect straight to the dashboard
    if (to.meta.isGuest && (authStore?.user && authStore.isLoggedIn)) {
        return {
            path: '/account/dashboard'
        }
    }

    // if user has to be logged in but is not, redirect straight to the login page
    if (to.meta.isUser && (!authStore?.user || !authStore.isLoggedIn)) {
        return {
            path: '/login'
        }
    }
})

export default router
