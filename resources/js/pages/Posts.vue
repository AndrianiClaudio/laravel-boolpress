<template>
<!-- <div class="container-fluid"> -->
  <Main :cards="cards" @changePage="changePage($event)"></Main>
    <!-- page links prev & next  -->
  <!-- <div class="row">
    <div class="col-12 text-center">
        <div class="btn-group mt-4" role="group">
          <button v-if="cards.prev_page_url" type="button" class="btn btn-light border-primary rounded-pill me-2" @click="setPage('prev_page_url')">
              Prev
          </button>
          <button v-if="cards.next_page_url" type="button" class="btn btn-light border-primary rounded-pill" @click="setPage('next_page_url')">
              Next
          </button>
        </div>
    </div>
  </div> -->
<!-- </div> -->
</template>

<script>
import Main from '../components/Main.vue';

export default {
  name: 'Posts',
  components: {
    Main,
  },
  data() {
    return {
      cards: {
        posts: [],
        next_page_url: null,
        prev_page_url: null,
      }
    }
  },
  methods: {
    changePage(vs) {
      let url = this.cards[vs];
      console.log(url);
      // console.log(url);
      if (url) {
          this.getPosts(url);
      }
    },
    // funzione con chiamata axios
    getPosts(url) {
      axios.get(url)
      .then((res) => {
        this.cards.posts = res.data.results.data;
        this.cards.next_page_url = res.data.results.next_page_url;
        this.cards.prev_page_url = res.data.results.prev_page_url;


        // console.log(this.posts);
      });
    },

  },
  created() {
    // otteni post
    this.getPosts('http://127.0.0.1:8000/api/v1/posts');
  }
}
</script>

<style>

</style>