<template>
<div class="container-fluid">
  <!-- POSTS -->
  <div class="row-cols-1">
      <div v-if="post" class="card h-100 mx-auto p-3">
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
                {{post.title}}
                
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
</template>

<script>
export default {
  name: 'Post',
  data() {
    return {
      post: null,
    }
  },
  props: ['id'],
  methods: {
    // funzione con chiamata axios
    getPost(url) {
      axios.get(url)
      .then((res) => {
        this.post = res.data.results.data;
        // console.log(this.post);
      });
    },
  },
  created() {
    // otteni post
    this.getPost(`http://127.0.0.1:8000/api/v1/posts/${this.id}`);
  }
}
</script>

<style>

</style>