import LoginPage from "@/Pages/Auth/Login.vue";
import Dashboard from "@/Pages/Dashboard/Dashboard.vue";
import Booking from "@/Pages/Bookings/Booking.vue";

const routes = [
    {
        path: '/bookings',
        name: 'Booking',
        component: Booking,
        meta: { isGuest: true }
    },
    {
        path: '/login',
        name: 'Login',
        component: LoginPage,
        meta: { isGuest: true }
    },
    {
        path: '/account/dashboard',
        name: 'Dashboard',
        component: Dashboard,
        meta: { isUser: true }
    },
];

export default routes
