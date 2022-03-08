<template>
  <main class="main py-4">
    <div class="row row-cols-1 row-cols-md-4 row-cols-lg-8 row-gap-3">
      <div class="py-2" v-for="(post,index) in posts" :key="`post-${index}`">
        <div class="card h-100">
          <div class="card-body">
            <h2 class="card-title">{{post.title}}</h2>
            <div class="row">
              <div class="col d-flex justify-content-between align-items-center">
                <span class="text-info h5" title="Category">{{post.category}}</span>
                <span class="text-secondary h6">Created by: {{post.author}}</span>
              </div>
            </div>
            <hr class="bg-primary">
            <p class="card-text">
              <em>
                {{post.content}}
              </em>
            </p>
            <hr class="bg-primary">
            <div v-if="post.tags.length > 0" class="container">
              <span v-for="tag in post.tags" :key="`${tag}`" class="badge rounded-pill bg-secondary me-3">{{tag}}</span>
            </div>
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