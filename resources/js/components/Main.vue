<template>
<div class="container-fluid">
  <div class="row px-3 g-0 row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
    <div class="p-3" v-for="(post,index) in posts" :key="`post-${index}`">
      <div class="card h-100">
        <!-- POST IMAGE -->
        <img :src="'/storage/'+post.image" class="card-img-top" :alt="post.title">
        <div 
        class="card-body  d-flex flex-column justify-content-between" 
        >
          <!-- TITLE, CATEGORY, AUTHOR -->
          <div class="row py-2">
            <div class="col">
              <h2 class="card-title text-uppercase">{{post.title}}</h2>
              <div class="container-fluid g-0 d-flex justify-content-between">
                <span class="text-info h5 text-uppercase" title="Category">{{post.category}}</span>
                <span class="text-secondary h6">Created by: {{post.author}}</span>
              </div>
            </div>
          </div>
          <!-- CONTENT -->
          <div class="row py-2">
            <div class="col">
              <p class="card-text">
                <em class="fs-5">
                  {{post.content}}
                </em>
              </p>
            </div>
          </div>
          <!-- TAGS -->
          <div class="row py-2">
            <div v-if="post.tags" class="container">
              <span v-for="tag in post.tags" :key="`${tag}`" class="badge fs-6 rounded-pill bg-secondary me-3">#{{tag}}</span>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- page links prev & next  -->
  <div class="row">
    <div class="col-12 text-center">
        <div class="btn-group mt-4" role="group">
          <button v-if="prev_page_url" type="button" class="btn btn-light border-primary rounded-pill me-2" @click="setPage('prev_page_url')">
              Prev
          </button>
          <button v-if="next_page_url" type="button" class="btn btn-light border-primary rounded-pill" @click="setPage('next_page_url')">
              Next
          </button>
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
      next_page_url: null,
      prev_page_url: null,
    }
  },
  methods: {
    getPosts(url) {
      axios.get(url)
      .then((res) => {
        this.posts = res.data.results.posts.data;
        // console.log(this.posts);
        this.next_page_url = res.data.results.posts.next_page_url;
        this.prev_page_url = res.data.results.posts.prev_page_url;
        // console.log(res.data.results.posts.next_page_url);
      });
    },
    setPage(url) { 
      if(this[url]) {
        this.getPosts(this[url]);
      }
    }
  },
  created() {
    this.getPosts('http://127.0.0.1:8000/api/posts');
  }
}
</script>

<style>

</style>