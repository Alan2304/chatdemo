
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('chat-message', require('./components/ChatMessage.vue'));
Vue.component('chat-log', require('./components/ChatLog.vue'));
Vue.component('chat-composer', require('./components/ChatComposer.vue'));

const app = new Vue({
    el: '#app',
    data:{
      messages: [],
      usersInRoom: [],
      group_id: $('#group_id').val()
    },
    methods:{
      addMessage(message){
        //Add to existing messagesent
        this.messages.push(message);

        //persist to the database
        axios.post('/messages/' + message.jsonMessage, message).then((response) => {/*console.log(response); */});
      }
    },
    created(){
      axios.get('/messages/' + this.group_id).then(response => {
          this.messages = response.data;
      });

      Echo.join('chatroom')
                    .here((users) => {
                        this.usersInRoom = users;
                    })
                    .joining(user => {
                      this.usersInRoom.push(user);
                    })
                    .leaving((user) => {
                        this.usersInRoom = this.usersInRoom.filter(u => u != user);
                    })
                    .listen('MessagePosted', (e) => {
                      console.log(e.message.group_id);
                      console.log(this.group_id);
                      if (this.group_id == e.message.group_id) {
                        this.messages.push({
                          message:e.message.message,
                          user:e.user
                        });
                      }
                    })
    }
});
