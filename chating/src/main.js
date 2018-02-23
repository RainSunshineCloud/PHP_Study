import Vue from 'vue'
import chating from './components/chating'

const routes = {
  '/': chating
}

/* eslint-disable no-new */

new Vue({
  el: '#app',
  data: {
    currentRoute: window.location.pathname
  },
  computed: {
    ViewComponent () {
      return routes[this.currentRoute]
    }
  },
  render (h) { return h(this.ViewComponent) }
})
