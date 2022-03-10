<template>
  <!-- <div> -->
    <Main :cards="cards" @changePage="changePage($event)"></Main>
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