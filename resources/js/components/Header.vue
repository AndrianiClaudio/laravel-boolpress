<template>
  <div class="row">
    <div class="col d-flex justify-content-center">
      <ul class="list-inline">
        <li v-for="(item,index) in menu.items" :key="`item-${index}`" class="list-inline-item">
          <a :href="item.href" class="list-group-item list-group-item-action">{{item.name}}</a>
        </li>
      </ul>
    </div>
  </div>

</template>

<script>
  export default {
    name: "Header",
    data() {
      return {
      // logo: require('../../img/ ... '),
      menu: {
        items: [
          {
              name: 'Home',
              href: 'home'
          },
          {
              name: 'Post',
              href: 'posts'
          },
          {
              name: 'Chi Siamo',
              href: 'about'
          }
        ]
      }
      }
    },
  }
</script>

<style lang="scss">
</style>