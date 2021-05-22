// window.Vue = require('vue').default;
import Vue from "vue"


// require('../../../../public/Themes/tabler/js/vendors/jquery-3.2.1.min.js');

Vue.component('hello-world',require('./components/HelloWorld.vue').default);
Vue.component('test',require('./components/Test.vue').default);




const app = new Vue({
    el: '#app',
});
// const app = new Vue({
//     el:'#app',
//     data(){
//         return {
//             message:' welcome'
//         }
//     }
//
// })