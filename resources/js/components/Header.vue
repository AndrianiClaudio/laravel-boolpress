<template>
<header class="header">

  <div class="row">
    <div class="col d-flex justify-content-center">
      <ul class="list-inline">
        <li v-for="(item,index) in menu.items" :key="`item-${index}`" class="list-inline-item">
          <router-link class="nav-link text-dark text-uppercase" :to="{ name: item.routeName}">{{ item.name }}</router-link>
        </li>
      </ul>
    </div>
  </div>
</header>

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