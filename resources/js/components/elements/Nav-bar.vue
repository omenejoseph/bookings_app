<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <router-link class="navbar-brand" :to="{name:'home'}">Bookings App</router-link>
        <button @click="logOut" class="btn-outline-primary">sign-out</button>
    </nav>
</template>

<script>
    import AuthService from "../../services/auth-service";
    export default {
        name: "Nav-bar",
        methods: {
            logOut(event){
                event.preventDefault();
                AuthService.logOut();
                this.$router.push({name: "home"})
            }
        }
    }
</script>

<style scoped>

</style>