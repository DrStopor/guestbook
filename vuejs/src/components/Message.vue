<template>
  <div class="container">
    <div class="row" v-for="message of messages" :key="message.id">
      <div class="col-md-8 test1 offset-md-2">
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
  }
}
</script>

<style scoped>

</style>