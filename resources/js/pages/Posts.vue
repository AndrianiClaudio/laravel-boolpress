<template>
<div class="container-fluid">
  <!-- POSTS -->
  <div class="row px-3 g-0 row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
    <div class="p-3" v-for="(post,index) in posts" :key="`post-${index}`">
      <div class="card h-100">
        <!-- POST IMAGE -->
        <img v-if="post.image" :src="'/storage/'+post.image" class="card-img-top" :alt="post.title">
        <div 
        class="card-body  d-flex flex-column justify-content-between" 
        >
          <!-- TITLE, CATEGORY, AUTHOR -->
          <div class="row py-2">
            <div class="col">
              <!-- TITLE WITH LINK TO @SHOW -->
              <h2 class="card-title text-uppercase">
                <a :href="`/posts/${post.id}`" class="text-decoration-none">{{post.title}}</a>
                
              </h2>
              <div class="container-fluid g-0 d-flex justify-content-between">
                <span class="text-info h5 text-uppercase" title="Category">{{post.category.name}}</span>
                <span class="text-secondary h6">Created by: {{post.user.name}}</span>
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
          <div v-if="post.tag.length > 0" class="row py-2">
            <div class="container">
              <span v-for="tag in post.tag" :key="`${tag}`" class="badge fs-6 rounded-pill bg-secondary me-3">#{{tag.name}}</span>
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
  name: 'Posts',
  data() {
    return {
      posts: [],
      next_page_url: null,
      prev_page_url: null,
    }
  },
  methods: {
    // funzione con chiamata axios
    getPosts(url) {
      axios.get(url)
      .then((res) => {
        this.posts = res.data.results.data;
        this.next_page_url = res.data.results.next_page_url;
        this.prev_page_url = res.data.results.prev_page_url;


        console.log(this.posts);
      });
    },
    // funzione per cambiare pagina 
    setPage(url) { 
      if(this[url]) {
        this.getPosts(this[url]);
      }
    }
  },
  created() {
    // otteni post
    this.getPosts('http://127.0.0.1:8000/api/v1/posts');
  }
}
</script>

<style>

</style>