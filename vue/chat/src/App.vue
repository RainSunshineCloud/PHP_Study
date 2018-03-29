<template>
  <div id="app">
    <router-view v-bind:msgs='msgs' v-bind:people='people' v-bind:me='me' />
  </div>
</template>

<script>
export default {
  name: 'App',
  data () {
  return {
	  	msgs: { 
	        '1': {
	          '1': {
	            time: '2018-1-3',
	            data: '王五在哪',
	            say: 3
	          }
	        },
	        '2': {
	          '1': {
	            time: '2018-1-3',
	            data: '李四在哪',
	            say: 3
	          },
	          '2': {
	            time: '2018-1-3',
	            data: '我不知道',
	            say: 1
	          }
	        }
	    },
	    people: {
        '1':{
          'name': '李四',
          'id': 1,
          'unread': 4
        },
        '2':{
          'name': '王五',
          'id': 2,
          'unread': 5
        }
      },
      me: {
        id: 1,
        name: '李四',
        to: null
      }
  	
  	};
  }
}
</script>

<style>

</style>
