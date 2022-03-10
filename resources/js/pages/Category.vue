<template>
<div class="container-fluid">
  <Main :cards="cards" @changePage="changePage($event)"></Main>
</div>
</template>

<script>
import Main from './../components/Main.vue';

export default {
  name: 'Category',
  components:{
    Main,
  },
  data() {
    return {
      cards: {
        posts: [],
        // count:0,
        next_page_url: null,
        prev_page_url: null,
      },
    }
  },
  props: ['id'],
  methods: {
    // funzione con chiamata axios
    getPost(url) {
      axios.get(url)
      .then((res) => {
        this.cards.posts = res.data.results.data;
        // this.cards.count = res.data.results.count;
        this.cards.next_page_url = res.data.results.next_page_url;
        this.cards.prev_page_url = res.data.results.prev_page_url;
      });
    },
    changePage(vs) {
      let url = this.cards[vs];
      // console.log(url);
      if (url) {
          this.getPosts(url);
      }
    },
  },
  created() {
    this.getPost(`http://127.0.0.1:8000/api/v1/categories/${this.id}`);
  }
}
</script>

<style>

</style>