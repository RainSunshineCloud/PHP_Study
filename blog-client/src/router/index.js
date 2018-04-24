import Vue from 'vue'
import Router from 'vue-router'
import blog from '@/components/blog'
import layout from '@/components/layout/layout'
import communication from '@/components/communication'
import friends from '@/components/friends'
import project from '@/components/project'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'layout',
      component: layout,
      children: [
	      {
	      	path: '/',
	      	name: 'blog',
	      	component: blog
	      },
	      {
	      	path: 'communication',
	      	name: 'communication',
	      	component: communication
	      },
	      {
	      	path: 'friends',
	      	name: 'friends',
	      	component: friends
	      },
	      {
	      	path: 'project',
	      	name: 'project',
	      	component: project
	      }
      ]
    }
  ],
  mode:"history"
})
