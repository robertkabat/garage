import {defineStore} from "pinia";
import AuthStore from "@/Store/Auth/store";

export const useAuthStore = defineStore('AuthStore', AuthStore)
