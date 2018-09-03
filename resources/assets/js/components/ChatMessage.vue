<template lang="html">
    <div class="chat-message">
      <p><strong class="user">{{ message.user.name }} :</strong></p>
      <p> {{ message.message }} </p>
    </div>
</template>

<script>
    export default{
      props: ['message']
    }
</script>

<style media="screen">
.chat-message{
  padding: 1rem;
}

.chat-message>p{
  margin-bottom: .5rem;
}

.chat-composer{
  display: flex;
}

.chat-composer input{
  flex: 1 auto;
}

.chat-composer button{
  border-radius: 0;
}

.chat-message strong.user{
  font-size: 16px;
}

</style>
