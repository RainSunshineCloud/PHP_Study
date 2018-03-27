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
                <p v-if='now.say==me.id' class='text-left'>
                {{ now.say }} say {{ now.data }} at {{ now.time }}
                </p>

                <p v-else class='text-right'>
                {{ now.say }} say {{ now.data }} at {{ now.time }}
                </p>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'HelloWorld',
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
      now_show: {
      },
      people: [
        {
          'name': '李四',
          'id': 1,
          'unread': 4
        },
        {
          'name': '王五',
          'id': 2,
          'unread': 5
        }
      ],
      me: {
        id: 1,
        name: '张三'
      }
    }
  },
  methods: {
    show_msg: function (id) {
      this.now_show = this.msgs[id]
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .my_h1 {
        text-align:center;
        background:yellow;
        margin:0;
    }
    .my_left {
        background:green;
    }
    .my_right {
        background:lightblue;
    }
    .my_main {
        min-height:400px;
        margin:0px;
        padding:0px;
    }

    .my_container {
        margin:0px;
        padding:0px;
    }
    .my_unread {
        color:red
    }
</style>
