<template>
  <div class="container">
    <div class="row" v-for="message of messages" :key="message.id">
      <div class="col-md-8 baseBlock offset-md-2">
        <div class="header-message row">
          <div class="theme">
            <b>Тема:</b> {{ message.theme }}
          </div>
          <div class="author">
            <b>Автор:</b> {{ message.user_name }}
          </div>
        </div>
        <div class="body-message">
          {{ message.text }}
        </div>
        <div class="footer-message">
          <div class="delete">
            <span class="btn btn-secondary" title="удалить сообщение" @click="deleteMessage(message.id)">
              X
            </span>
          </div>
          <div class="time">
            <b>Время:</b> {{ message.created_time }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'message',
  props: {
    messages: {
      type: Array,
      required: true
    }
  },
  methods: {
    deleteMessage(id) {
      this.$emit('deleteMessage', id);
    }
  }
}
</script>