<template>
<div class="container-fluid">
  <!-- CARDS  -->
  <div class="row px-3 g-0 row-cols-1 row-cols-md-2 " v-if="cards.posts">
    <!-- POSTS -->
    <div class="col p-2" v-for="post in cards.posts" :key="post.id">
      <div class="card h-100">
        <img v-if="post.image" :src="'/storage/'+post.image" class="card-img-top" :alt="post.title">

        <div class="card-body py-2">
          <h5 class="card-title text-uppercase">
            <router-link class="text-dark text-decoration-none" :to = "{ name: 'post' , params: {id: post.id}}">
              {{ post.title }}
            </router-link>
          </h5>

          <div class="container-fluid g-0 d-flex justify-content-between">
            <span class="text-info h5 text-uppercase" title="Category">{{post.category.name}}</span>
            <span class="text-secondary h6">Created by: {{post.user.name}}</span>
          </div>

          <p class="card-text">{{ post.content }}</p>

          <!-- TAGS -->
          <div v-if="post.tag.length > 0" class="row py-2">
            <div class="container">
              <span v-for="(tag,index) in post.tag" :key="`tag-${index}`" class="badge fs-6 rounded-pill bg-secondary me-3">#{{tag.name}}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- NO CARD -->
  <div class="row" v-else>
    <div class="col text-center">
      <h3>Non sono presenti post da visualizzare.</h3>
    </div>
  </div>
  <!-- NEXT & PREV PAGES  -->
  <div v-if="cards.next_page_url || cards.prev_page_url" class="col-12 text-center">
  <div class="btn-group mt-4" role="group">
    <button v-if="cards.prev_page_url" type="button" class="btn btn-light border-primary rounded-pill me-2" @click="changePage('prev_page_url')">
        Prev
    </button>
    <button v-if="cards.next_page_url" type="button" class="btn btn-light border-primary rounded-pill" @click="changePage('next_page_url')">
        Next
    </button>
  </div>
</div>
</div>
</template>


<script>
  export default {
    name: "Main",
    props: ['cards'],
    methods: {
      // funzione per cambiare pagina 
      changePage(url) { 
        this.$emit('changePage',url)
      }
    },
  }
</script>

<style lang="scss" scoped>
</style>