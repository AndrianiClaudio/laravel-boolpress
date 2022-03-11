<template>
<!-- <header class="header"> -->
  <div class="row">
    <div class="col">
      <ul class="navbar navbar-nav-inline justify-content-center navbar-light bg-primary shadow-sm">
        <li v-for="(item,index) in menu.items" :key="`item-${index}`" class="list-inline-item p-2">
          <router-link class="nav-item text-light text-decoration-none text-uppercase" :to="{ name: item.routeName}">{{ item.name }}</router-link>
        </li>
      </ul>
    </div>
  </div>
<!-- </header> -->

</template>

<script>
  export default {
    name: "Header",
    data() {
      return {
        menu: {
          items: [
            {
                name: 'Home',
                routeName: 'home'
            },
            {
                name: 'Post',
                routeName: 'posts'
            },
            {
                name: 'Chi Siamo',
                routeName: 'about'
            },
            {
                name: 'Contatti',
                routeName: 'contacts'
            }
          ]
        }
      }
    },
    methods: {

    },
  }
</script>

<style lang="scss">
</style>