import { createApp } from 'vue';
import { createRouter, createWebHashHistory  } from "vue-router";
import { routes } from "./routes";
import "@fortawesome/fontawesome-free/css/all.css";
import 'bootstrap/dist/css/bootstrap.min.css'
import App from './App.vue'
import PrimeVue from 'primevue/config';
import 'primevue/resources/themes/lara-light-green/theme.css'
import store from "./store"
let app = createApp(App)
const router = createRouter({
history: createWebHashHistory (),
routes: routes,
})
app.use(router);
app.use(PrimeVue);
app.use(store)
app.mount("#app")

router.beforeEach(async (to, from, next) => {
    if (to.matched.some(record => record.meta.isAuth)) {
        let token = localStorage.getItem('token');
        if (!token) {
            next("/login");
        } else {
            console.log(token);
            next(); // Mettre next() ici après avoir vérifié l'authentification
        }
    } else {
        next(); // Mettre next() ici si la route n'a pas besoin d'authentification
    }
  });
