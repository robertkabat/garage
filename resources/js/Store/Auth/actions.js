import axios from "axios";
import router from "@/Router/router";

const actions = {
    async logIn() {
        const response = await axios.post('/login', { email:'admin@pub.com', password: 'password' })
        if (response.status === 200) {
            console.log(response, 'response here!')
            const user = await axios.get('/api/user')
            this.setUser(user.data)
            this.setLoggedIn(true)
            router.push({ name: 'Dashboard' })
        }
    },
    async logout() {
        const response = await axios.post('/logout')
        console.log(response, 'loggin out try')
        if (response.status === 204) {
            console.log(response, 'logging out')
            this.setUser(null)
            this.setLoggedIn(false)
            router.push({ name: 'Login' })
        }
    },
    setUser(user) {
        this.user = user
    },
    setLoggedIn(loggedIn) {
        this.isLoggedIn = loggedIn
    }
}
export default actions
