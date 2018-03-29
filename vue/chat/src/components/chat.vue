<template>
  <div class='my_container'>
    <h1 class='my_h1'>{{me.name}}的聊天室</h1>
    <div class='row my_main'>
        <div class='col-md-4 my_left'>
            <ul>
                <li v-for='peo in people' v-on:click="show_msg(peo.id)">
                    {{ peo.name }}
                    <span class='my_unread'>未读({{ peo.unread }})条</span>
                </li>
            </ul>
        </div>
        <div class='col-md-8 my_right'>
            <div v-for='now in now_show' >
                <p v-if='now.say==me.id' class='text-left my_show_left'>
                {{ now.say }} say {{ now.data }} at {{ now.time }}
                </p>

                <p v-else class='text-right my_show_right'>
                {{ now.say }} say {{ now.data }} at {{ now.time }}
                </p>
            </div>
            <div class='my_input'>
                <input class='form-control my_text_input' v-on:keyup.enter='send' v-model.trim='content'>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
export default {
  name: 'chat',
  props: [
    'msgs',
    'me',
    'people'
  ],
  data () {
    return {
      content: '',
      now_show: {
      }
    }
  },
  methods: {
    show_msg: function (id) {
      this.now_show = this.msgs[id];
      this.me.to = id;
    },
    send: function () {
      if (this.me.to === null) {
        alert('请选择聊天对象');
        return false;
      } 

      if (this.content === '') {
        alert('请输入聊天信息');
        return false;
      }
      let index = parseInt(Object.keys(this.msgs[this.me.to]).pop()) + 1;
      this.GLOBAL.ws.send({
          'msg': this.content,
          'to': this.me.to
      });
      Vue.set(this.msgs[this.me.to],index, {
          'time': '2018-1-1',
          'data': this.content,
          say: this.me.id
        });
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .my_container {
        margin:0px;
        padding:0px;
    }
    .my_unread {
        color:red
    }
    .my_h1 {
        text-align:center;
        background:yellow;
        margin:0;
    }
    .my_main {
        min-height:400px;
        margin:0px;
        padding:0px;
    }
    .my_left {
        background:green;
    }
    .my_right {
        background:lightblue;
        position:relative;
        padding:0;
    }

    .my_input {
        position:absolute;
        background:inherit;
        width:100%;
        bottom:4px;
        padding:0;
    }
    .my_text_input {
        padding:0;
        width:98%;
        margin:0 1%;

    }
    .my_show_left {
      margin-left:10px;
    }
    .my_show_right {
      margin-right:10px;
    }
</style>
