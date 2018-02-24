import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import chating from '@/components/chating'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'HelloWorld',
      component: HelloWorld
    },
    {
      path: '/chating',
      name: 'chating',
      component: chating,
      meta: {aa: 'aaa',msg: 'sdf'}
    }
  ],
  mode: 'history'
})
