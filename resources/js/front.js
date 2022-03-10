require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
Vue.use(VueRouter);

// import pages
import App from './views/App';
import Home from './pages/Home.vue';
import Posts from './pages/Posts.vue';
import About from './pages/About.vue';
import Contacts from './pages/Contacts.vue';

const router = new VueRouter({
    mode: 'history',
        routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            
        },
        {
            path: '/posts',
            name: 'posts',
            component: Posts,
            
        },
        {
            path: '/about',
            name: 'about',
            component: About,
        },
        {
            path: '/contacts',
            name: 'contacts',
            component: Contacts,
        },
    ]
});

const app = new Vue({
    el: '#app',
    render: h => h(App),
    router
});
