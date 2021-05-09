import Vue from 'vue';
import App from './App.vue';
import Vuelidate from "vuelidate";
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import store from './store/watchdog';
import Paginate from 'vuejs-paginate';
import router from './router';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';


Vue.config.productionTip = false;
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(Vuelidate);
Vue.component('paginate', Paginate);

new Vue({
  router,
  store,
  render: h => h(App),
}).$mount('#app')
