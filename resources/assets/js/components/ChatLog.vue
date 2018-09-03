<template lang="html">
  <div class="chat-log">
    <div class="tooMuch">
      <chat-message v-for="message in messages" :message="message"></chat-message>
      <div class="empty" v-show="messages.length === 0">
        Nothing Here Yet
      </div>
    </div>

  </div>
</template>

<script>
export default{
  props:['messages']
}

</script>

<style lang="css">
    .chat-log .chat-message:nth-child(odd){
      background-color: #3ec5f0;
      color: white;
    }

    .empty{
      padding: 1rem;
      text-align: center;
    }

    .tooMuch{
      overflow-y: scroll;
      height: 350px;
    }
</style>
