<template>
  <div class="container">
    <div class="col-md-12">
<!--      <message :messages="items" />-->
      <message :messages="messages" :key="watchKey" />
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
    <add-message/>
  </div>
</template>

<script>
import AddMessage from "./AddMessage";
import message from "./Message";
//import messageService from "./service/message.service";
//import paginationMixin from '../mixins/pagination.mixin';
import {mapGetters, mapActions} from 'vuex';

export default {
  name: 'messages',
  //mixins: [paginationMixin],
  components: {message, AddMessage},
  computed: mapGetters(['messages', 'pageCount', 'watchKey']),
  data(){
    return {
      page: +this.$route.query.page || 1,
      watchKey: 0,
    }
  },
  /*methods: {
    async init() {
      const {status, data} = await messageService.getAllMessage();
      if (status === 200) {
        this.messages = data;
        this.setupPagination(data);
      }
    }
  },*/
  methods: {
    ...mapActions(['getByPage', 'fetchPageCount']),
    pageChangeHandler(page) {
      this.$router.push(`${this.$route.path}?page=${page}`);
      this.getByPage(page-1);
    },
    incrementWatchKey() {
      this.watchKey++;
    }
  },
  async mounted() {
    /*await this.init();*/
    /*this.$store.dispatch('fetchMessages');*/
    //this.fetchMessages();
    this.fetchPageCount();
    this.getByPage(this.page-1);
  }
}
</script>

<style scoped>

</style>