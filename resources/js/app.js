import Vue from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue'
import VueToastr from "vue-toastr";
import { Link } from '@inertiajs/inertia-vue'
// use plugin
Vue.use(VueToastr);
Vue.component('inertia-link', Link)

createInertiaApp({
  resolve: name => require(`./Pages/${name}`),
  setup({ el, App, props }) {
    new Vue({
      render: h => h(App, props),
    }).$mount(el)
  },
})
