<script setup>
import {useAuthStore} from "@/Store/store";

const authStorage = useAuthStore()
</script>

<template>
    <nav class="flex items-center bg-[#001D15] px-[15px] h-[55px] w-full">
        <div class="flex max-w-7xl w-full mx-auto text-white">
            <div class="flex gap-[20px] grow">
                <router-link :to="{ name: 'Dashboard' }">Dashboard</router-link>
                <a @click="authStorage.logout" href="#">Logout</a>
            </div>
        </div>
    </nav>
</template>
