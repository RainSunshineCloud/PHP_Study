<template>
<div class="container-fluid my-container" id='chating'>
  <div class='row my-contact'>
    <div class="col-xs-3 col-sm-3 col-md-3 text-left">{{user}}</div>
    <div class="col-xs-6 col-sm-6 col-md-6 text-center">未读信息:<b class='my-umsg'>1</b>条</div>
    <div class="col-xs-2 col-sm-2 col-md-3 text-right">12:80</div>
  </div>
  <div class='row my-content'>
    <div class="col-xs-2 col-sm-2 col-md-2 text-left my-concat">2</div>
    <div class="col-xs-10 col-sm-10 col-md-10 text-left my-msg" >
      <div class='my-main'>

      </div>
      <div class='my-submit'>
          <input type="text" class="form-control form-control " placeholder="请输入">
      </div>
    </div>
  </div>
</div>
</template>

<script></script>

<style>
  .my-container {
    max-width:800px;
  }
  .my-umsg {
    color:#d9534f;
  }
  .my-content {
    height:500px;
  }
  .my-concat {
    background:rgba(255,255,0,0.5);
  }
  .my-msg {
    background:rgba(255,0,255,0.5);
  }

  .my-main{
    height:450px;
  }
  .my-submit{
    height:50px;
  }

</style>
