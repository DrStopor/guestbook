<template>
  <div class="container">
    <div class="row">
      <div class="col-md-10 text-center offset-1">
        <h2>Лучше писать на виртуальной стене, чем на заборе</h2>
        <h4>Напиши, что думаешь <span class="text-to-small">(форма отправки сообщения внизу страницы)</span></h4>
      </div>

    </div>
    <div class="col-md-12">
      <message :messages="messages" :key="watchKey" @deleteMessage="deleteMessage"/>
    </div>
    <nav aria-label="Page navigation" class="offset-md-4">
      <paginate
          v-model="page"
          :page-count="pageCount"
          :prev-text="'Назад'"
          :next-text="'Вперед'"
          :container-class="'pagination'"
          :page-class="'page-item'"
          :page-link-class="'page-link'"
          :prev-class="'page-item'"
          :prev-link-class="'page-link'"
          :next-class="'page-item'"
          :next-link-class="'page-link'"
          :click-handler="pageChangeHandler"
          />
    </nav>
    <add-message  @addedMessage="addedMessage"/>
  </div>
</template>

<script>
import AddMessage from "./AddMessage";
import message from "./Message";
import {mapGetters, mapActions} from 'vuex';

export default {
  name: 'messages',
  components: {message, AddMessage},
  computed: mapGetters(['messages', 'pageCount']),
  data(){
    return {
      page: +this.$route.query.page || 1,
      watchKey: 0,
    }
  },
  methods: {
    ...mapActions(['getByPage', 'fetchPageCount', 'delete', 'storePage', 'justUpdateMessages']),
    async deleteMessage(id) {
      this.storePage(this.page-1);
      this.delete(id);
      this.fetchPageCount();
    },
    async addedMessage() {
      this.storePage(this.page-1);
      this.justUpdateMessages();
      this.fetchPageCount();
    },
    /**
     * Задает URL и запрашивает данные для страницы, на которой находимся
     * @param page
     */
    pageChangeHandler(page) {
      this.$router.push(`${this.$route.path}?page=${page}`);
      this.getByPage(page-1);
      this.fetchPageCount();
    }
  },
  async mounted() {
    this.fetchPageCount();
    this.getByPage(this.page-1);
  }
}
</script>

<style scoped>

</style>