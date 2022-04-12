<template>
    <div
        class="container-fluid bg-primary w-100 d-flex justify-content-between"
    >
        <!-- Left-side -->
        <ul
            class="navbar navbar-nav-inline mb-0 justify-content-center navbar-light shadow-sm"
        >
            <li class="list-inline-item p-2">
                <a
                    class="nav-item text-light text-decoration-none text-uppercase"
                    href="http://127.0.0.1:8000/login"
                    >Accedi</a
                >
            </li>
            <li class="list-inline-item p-2">
                <a
                    class="nav-item text-light text-decoration-none text-uppercase"
                    href="http://127.0.0.1:8000/register"
                    >Registrati</a
                >
            </li>
        </ul>
        <!-- Right-side -->
        <ul
            class="navbar navbar-nav-inline mb-0 justify-content-center navbar-light shadow-sm"
        >
            <li
                v-for="(item, index) in menu.items"
                :key="`item-${index}`"
                class="list-inline-item p-2"
            >
                <router-link
                    class="nav-item text-light text-decoration-none text-uppercase"
                    :to="{ name: item.routeName }"
                    >{{ item.name }}</router-link
                >
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "Header",
    data() {
        return {
            menu: {
                items: [
                    {
                        name: "Home",
                        routeName: "home",
                    },
                    {
                        name: "Post",
                        routeName: "posts",
                    },
                    {
                        name: "Chi Siamo",
                        routeName: "about",
                    },
                    {
                        name: "Contatti",
                        routeName: "contacts",
                    },
                ],
            },
        };
    },
    methods: {},
};
</script>

<style lang="scss"></style>
