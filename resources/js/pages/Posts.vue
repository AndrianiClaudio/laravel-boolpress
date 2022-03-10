<template>
<div class="container-fluid">
  <div class="row search mb-3 p-3 bg-light">
    <div class="col-12">
      <form>
          <!-- <h2>Search</h2> -->
          <!-- <div class="row">
            <div class="mb-3 col-2">
              Order By Column
              <select class="form-select form-select" name="orderbycolumn" id="orderbycolumn"
                  v-model="form.orderbycolumn">
                <option value="name">Name</option>
                <option value="price">Price</option>
                <option value="created_at">Created</option>
                <option value="updated_at">Updated</option>
              </select>
            </div>
            <div class="mb-3 col-2">
              Order By Versus
              <select class="form-select form-select" name="orderbysort" id="orderbysort"
                  v-model="form.orderbysort">
                <option value="asc">Asc</option>
                <option value="desc">Desc</option>
              </select>
            </div>
          </div> -->
          <!-- SELECT TAGS -->
          <div class="row">
            <div class="mb-3 col-12 ">
              <fieldset>
                <legend>Tags</legend>
                <ul class="list-group-horizontal d-flex align-items-center flex-wrap">
                  <li class="list-group-item " v-for="(tag, index) in tags" :key="`tag-${index}`" >
                      <input class="me-2" type="checkbox" name="tags[]" :value="tag.name" v-model="selected.tags">
                      <label :for="tag.name">{{tag.name}}</label>
                  </li>
                </ul>
              </fieldset>
            </div>
          </div>
          <!-- FILTER ELEMENTS -->
          <div class="row">
            <div class="col-2">
              <input class="btn btn-info" type="button" value="filtra" @click.prevent="filterPosts">
            </div>
          </div>
      </form>
    </div>
  </div>
  <Main :cards="cards" @changePage="changePage($event)"></Main>
</div>
</template>

<script>
import Main from '../components/Main.vue';

export default {
  name: 'Posts',
  components: {
    Main,
  },
  data() {
    return {
      cards: {
        posts: [],
        next_page_url: null,
        prev_page_url: null,
      },
      selected: {
        tags:[],
      },
      tags: [],
    }
  },
  methods: {
    filterPosts () {
      // console.log('search', this.selected);
      axios.get('http://127.0.0.1:8000/api/v1/posts/filter', {params: this.selected})
      .then((res) => {
              // console.log(res);
              this.cards.posts = res.data.results.data;
              this.cards.next_page_url = res.data.results.next_page_url;
              this.cards.prev_page_url = res.data.results.prev_page_url;
          });
    },
    changePage(vs) {
      let url = this.cards[vs];
      // console.log(url);
      if (url) {
          this.getPosts(url);
      }
    },
    // funzione con chiamata axios
    getPosts(url) {
      axios.get(url)
      .then((res) => {
        this.cards.posts = res.data.results.data;
        this.cards.next_page_url = res.data.results.next_page_url;
        this.cards.prev_page_url = res.data.results.prev_page_url;
        // console.log(res.data.results.data);
      });
    },
    getTags() {
      axios.get('http://127.0.0.1:8000/api/v1/tags')
      .then((res) => {
        this.tags = res.data.results.data;
      });
    }

  },
  created() {
    // otteni post
    this.getPosts('http://127.0.0.1:8000/api/v1/posts');
    this.getTags();
    // console.log(this.tags);
  }
}
</script>

<style>

</style>