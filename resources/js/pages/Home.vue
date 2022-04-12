<template>
    <!-- <div> -->
    <main>
        <input
            class="btn btn-primary border-pill d-block mx-auto mt-3"
            type="button"
            value="Mostra altri post"
            @click.prevent="randomPosts"
        />
        <Main :cards="cards" @changePage="changePage($event)"></Main>
    </main>
    <!-- </div> -->
</template>

<script>
import Main from "../components/Main.vue";

export default {
    name: "Home",
    components: {
        Main,
    },
    data() {
        return {
            cards: {
                posts: null,
                // count: 0,
                next_page_url: null,
                prev_page_url: null,
            },
        };
    },
    created() {
        this.getPosts("http://127.0.0.1:8000/api/v1/posts/random");
    },
    methods: {
        randomPosts() {
            this.getPosts("http://127.0.0.1:8000/api/v1/posts/random");
        },
        getPosts(url) {
            axios.get(url).then((result) => {
                this.cards.posts = result.data.results.data;
                // this.cards.count = res.data.results.count;
            });
        },
        // funzione per cambiare pagina
        changePage(url) {
            if (this[url]) {
                this.getPosts(this[url]);
            }
        },
    },
};
</script>

<style lang="scss"></style>
