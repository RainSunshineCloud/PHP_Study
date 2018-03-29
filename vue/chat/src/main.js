// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'

Vue.config.productionTip = false
var ws = new WebSocket('ws://192.168.218.128:8081');
Vue.prototype.GLOBAL = { 'ws': ws };

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>',
  created: function () {
  	ws.onopen = function () {
  	  alert(11);
      ws.send('sdfd');
  	};
    ws.onmessage = function (recv) {
      alert(recv.data);
    };
  	ws.onerror = function () {
  		alert('连接失败');
  	}
    this.ws = ws;
  }
})
