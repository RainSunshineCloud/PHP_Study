// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import route from './route.js'

new Vue({
  el: '#app',
  data: {
    currentRoute: window.location.pathname,
    user:'张一山'
  },
  computed: {
    ViewComponent () {
      return route[this.currentRoute] || NotFound
    }
  },
  render (h) { return h(this.ViewComponent) }
})



new Vue({
  el: '#chating',
  data: {
    user:'张一山'
  },

})