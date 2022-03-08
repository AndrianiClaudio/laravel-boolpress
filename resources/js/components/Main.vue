<template>
  <main class="main py-4">
    <div class="row row-cols-1 row-cols-md-4 row-gap-3">
      <div class="py-2" v-for="(post,index) in posts" :key="`post-${index}`">
        <div class="card h-100">
          <div class="card-body">
            <h2 class="card-title">{{post.title}}</h2>
            <hr class="bg-primary">
            <p class="card-text">
              <em>
                {{post.content}}
              </em>
            </p>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
export default {
  name: 'Main',
  data() {
    return {
      posts: [],

    }
  },
  created() {
    axios.get('http://127.0.0.1:8000/api/posts')
    .then((res) => {
      // console.log(res.data.results);
      this.posts = res.data.results;
    });
  }
}
</script>

<style>

</style>