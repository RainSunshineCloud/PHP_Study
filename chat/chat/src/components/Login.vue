<template>
  <div>
    <h1>登陆</h1>

  </div>
</template>

<script>
export default {
  data () {
    return {
      nicname: this.$store.state.userInfo.nicName
    }
  }
}
</script>
