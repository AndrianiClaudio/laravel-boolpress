<template>
    <div class="container-fluid">
        <div class="row search mb-3 p-3 bg-light">
            <div class="col-12">
                <form>
                    <!-- SELECT CATEGORY-->
                    <div class="row">
                        <div class="col mb-3 text-center">
                            <select
                                class="form-select"
                                name="category"
                                v-model="selected.category"
                            >
                                <option value="all" @click="filterPosts">
                                    Seleziona una categoria
                                </option>
                                <option
                                    @click="filterPosts"
                                    v-for="(category, index) in categories"
                                    :key="`category-${index}`"
                                    :value="category.name"
                                >
                                    {{ category.name }}
                                </option>
                            </select>
                            <fieldset>
                                <!-- SELECT TAGS -->
                                <legend class="text-center">Tags</legend>
                                <ul
                                    class="list-group-horizontal d-flex align-items-center flex-wrap"
                                >
                                    <li
                                        class="list-group-item"
                                        v-for="(tag, index) in tags"
                                        :key="`tag-${index}`"
                                    >
                                        <input
                                            class="me-2"
                                            type="checkbox"
                                            name="tags[]"
                                            :value="tag.name"
                                            v-model="selected.tags"
                                            @change="filterPosts"
                                        />
                                        <label :for="tag.name">{{
                                            tag.name
                                        }}</label>
                                    </li>
                                </ul>
                            </fieldset>
                        </div>
                    </div>

                    <!-- FILTER ELEMENTS -->
                    <div class="row">
                        <div class="col text-center">
                            <!-- <input
                                class="btn btn-info"
                                type="button"
                                value="filtra"
                                @click.prevent="filterPosts"
                            /> -->
                            <input
                                class="btn btn-warning"
                                type="button"
                                value="Reset"
                                @click.prevent="resetSelected"
                            />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <Main :cards="cards" @changePage="changePage($event)"></Main>
    </div>
</template>

<script>
import Main from "../components/Main.vue";

export default {
    name: "Posts",
    components: {
        Main,
    },
    data() {
        return {
            cards: {
                posts: [],
                // count: 0,
                next_page_url: null,
                prev_page_url: null,
            },
            selected: {
                tags: [],
                category: "all",
            },
            tags: [],
            categories: [],
        };
    },
    methods: {
        resetSelected() {
            this.selected.tags = [];
            this.selected.category = "all";
            this.getPosts("http://127.0.0.1:8000/api/v1/posts");
        },
        ms_axios_tags() {
            let query = "";

            this.selected.tags.forEach((tag, index) => {
                // console.log(tag);
                if (
                    (index === 0 && this.selected.tags.length === 1) ||
                    index === this.selected.tags.length - 1
                ) {
                    query += tag;
                } else {
                    if (index < this.selected.tags.length - 1) {
                        query += tag + "-";
                    }
                }
            });
            return query;
        },
        filterPosts() {
            // console.log('search', this.selected);
            axios
                .get("http://127.0.0.1:8000/api/v1/posts/filter", {
                    params: {
                        category: this.selected.category,
                        tags: this.ms_axios_tags(),
                    },
                })
                .then((res) => {
                    // console.log(res);
                    this.cards.posts = res.data.results.data;
                    // this.cards.count = res.data.results.count;
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
            axios.get(url).then((res) => {
                this.cards.posts = res.data.results.data;
                this.cards.count = res.data.results.count;
                this.cards.next_page_url = res.data.results.next_page_url;
                this.cards.prev_page_url = res.data.results.prev_page_url;
                // console.log(res.data.results.data);
            });
        },
        getTags() {
            axios.get("http://127.0.0.1:8000/api/v1/tags").then((res) => {
                this.tags = res.data.results.data;
            });
        },
        getCategories() {
            axios.get("http://127.0.0.1:8000/api/v1/categories").then((res) => {
                this.categories = res.data.results.data;
            });
        },
    },
    created() {
        // otteni post
        this.getPosts("http://127.0.0.1:8000/api/v1/posts");
        this.getTags();
        this.getCategories();
        // console.log(this.tags);
    },
};
</script>

<style></style>
