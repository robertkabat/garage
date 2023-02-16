import './bootstrap';
import {createApp} from 'vue'
import App from './Pages/App.vue'
import router from "@/Router/router";
import { createPinia } from 'pinia'
import { createPersistedState } from 'pinia-plugin-persistedstate'
import SecureLS from "secure-ls";

import '@vuepic/vue-datepicker/dist/main.css'

/***********************************************************************************************************************
 *
 * PINIA STORE CONFIG
 *
 ***********************************************************************************************************************/

const store = createPinia()
store.use(createPersistedState({
    storage: {
        getItem: (key) => {
            return (new SecureLS({ isCompression: false })).get(key)
        },
        setItem: (key, value) => {
            (new SecureLS({ isCompression: false })).set(key, value)
        }
    }
}))

const app = createApp(App)
app.use(store);
app.use(router);
app.mount("#app")
