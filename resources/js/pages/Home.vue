<template>
  <!-- <div> -->
    <div class="row">
      <div class="col text-center">
        <input class="btn btn-success border-pill" type="button" value="Load other random posts" @click.prevent="randomPosts">
        <Main :cards="cards" @changePage="changePage($event)"></Main>
      </div>
    </div>
  <!-- </div> -->
</template>

<script>
import Main from '../components/Main.vue';

  export default {
    name: 'Home',
    components: {
      Main
    },
    data() {
      return {
        cards: {
          posts: null,
          next_page_url: null,
          prev_page_url: null
        }
      }
    },
    created() {
      this.getPosts('http://127.0.0.1:8000/api/v1/posts/random');
    },
    methods: {
      randomPosts () {
        this.getPosts('http://127.0.0.1:8000/api/v1/posts/random');
      },
      getPosts(url){
          axios.get(url).then(
            (result) => {
              this.cards.posts = result.data.results.data;
            });
      },
      // funzione per cambiare pagina 
      changePage(url) { 
        if(this[url]) {
          this.getPosts(this[url]);
        }
      }
      
    }
  }
</script>

<style lang="scss">
</style>