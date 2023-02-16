import {defineStore} from 'pinia'
import UserState from "@/Store/Auth/state";
import UserGetters from "@/Store/Auth/getters";
import UserActions from "@/Store/Auth/actions";

const AuthStore = {
    state: () => {
        return {
            ...UserState
        }
    },
    getters: {
        ...UserGetters
    },
    actions: {
        ...UserActions
    },
    persist: true
}

export default AuthStore
