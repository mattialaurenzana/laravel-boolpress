import Vue from "vue";
import VueRouter from "vue-router";
import Home from './pages/Home';
import Contacts from './pages/Contacts'; //il nome in fase di import è uguale a quello specificato nella rotta
import PostDetails from './pages/PostDetails';
import Error from './pages/Error';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "//",
            component: Home,
            name: "home.index",
            meta:{title:"Homepage",linkText:"Homepage"}},
        {
            path: "/contacts",
            component: Contacts,
            name: "contacts.index",
            meta:{title:"Contatti",linkText:"Contacts"}
        },
        {
            path: "/posts/:post",
            component: PostDetails,
            name: "posts.show",
            meta: {title:"Dettagli post",linkText:"Dettagli"}
            
        },
        {
            path: "*",
            component: Error,
            name: "error",
            meta: {title: "Error"}

        }
    ]
});

router.beforeEach((to,from,next)=>{
    window.document.title = to.meta.title;
    next();
});

export default router;