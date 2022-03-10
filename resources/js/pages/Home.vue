<template>
  <div>
      <div class="container">
        <div class="row">
          <div class="col">
            <h1>Home</h1>
          </div>
        </div>
        <Main :posts="posts"></Main>
      </div>
  </div>
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
        posts: null,
      }
    },
    created() {
      this.getPosts('http://127.0.0.1:8000/api/v1/posts/random');
    },
    methods: {
      getPosts(url){
          axios.get(url).then(
            (result) => {
              this.posts = result.data.results.data;
            });
      }
      
    }
  }
</script>

<style lang="scss">
</style>