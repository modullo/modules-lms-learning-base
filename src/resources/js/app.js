window.Vue = require('vue').default;

require('../../../../public/Themes/tabler/js/vendors/jquery-3.2.1.min.js');

Vue.component('hello-world',require('./components/HelloWorld.vue').default);

// const app = new Vue({
//     el:'#app',
//     data(){
//         return {
//             message:' welcome'
//         }
//     }
//
// })