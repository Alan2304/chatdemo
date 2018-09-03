<template lang="html">
    <div class="chat-composer">
        <input type="text" placeholder="Start Typing your message" v-model="messageText" @keyup.enter="sendMessage">
        <button type="button" class="btn btn-primary" @click="sendMessage">Send</button>
    </div>
</template>

<script>
    export default{
      data(){
        return {
          messageText: ''
        }
      },
      methods:{
        sendMessage(){
          this.$emit('messagesent', {
            message: this.messageText,
            jsonMessage: '{"message" : "' + this.messageText + '", "group_id" :' + $('#group_id').val() +'}',
            user: {
                name: $('#navbarDropdown').text()
            }
            });
          this.messageText = '';
        }
      }
    }
</script>

<style media="screen">
  div.chat-composer{
    margin-top: 15px;
  }
</style>
