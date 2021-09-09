import Vue from 'vue';

import Login from './components/Login.vue';
import Register from './components/Register.vue';
import Dashboard from './components/Dashboard.vue';



const app = new Vue({
    el: '#app',
    components: {Login, Register, Dashboard}
});