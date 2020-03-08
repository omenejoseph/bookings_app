<template>
    <div>
        <nav-bar></nav-bar>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import NavBar from "./elements/Nav-bar";
    export default {
        name: "App",
        components: {NavBar},
    }
</script>

<style scoped>

</style>