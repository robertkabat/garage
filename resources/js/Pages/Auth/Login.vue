<script setup>
import SimpleCenteredPage from "@/Layouts/SimpleCenteredPage.vue";
import {useAuthStore} from "@/Store/store";

const authStore = useAuthStore()

</script>

<template>
    <SimpleCenteredPage>
        <button class="px-3 py-2 bg-green-800 text-white rounded mb-2" @click="authStore.logIn()">LOG IN</button>
        <small>For simplicity credentails are hard coded, normally they would come from the form.</small>
    </SimpleCenteredPage>
</template>
