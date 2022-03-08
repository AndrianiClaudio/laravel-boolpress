<template>
    <div class="row g-0 row-cols-1 row-cols-md-4 row-cols-lg-8">
      <div class="p-3" v-for="(post,index) in posts" :key="`post-${index}`">
        <div class="card h-100">
          <div class="card-body">
            <h2 class="card-title">{{post.title}}</h2>
            <div class="row">
              <div class="col d-flex justify-content-between align-items-center">
                <span class="text-info h5 text-uppercase" title="Category">{{post.category}}</span>
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
            <div v-if="post.tags" class="container">
              <span v-for="tag in post.tags" :key="`${tag}`" class="badge fs-6 rounded-pill bg-secondary me-3">#{{tag}}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
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
      this.posts = res.data.results.posts;
      console.log(res.data.results.posts);
    });
  }
}
</script>

<style>

</style>