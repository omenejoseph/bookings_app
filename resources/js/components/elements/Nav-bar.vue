<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-between">
        <router-link class="navbar-brand" :to="{name:'home'}">Bookings App</router-link>
        <div v-if="isLoggedIn">
            <span  class="text-light pr-2" >Hello {{currentUser.username}}</span>
            <button @click="logOut" class="btn-outline-primary float-right">sign-out</button>
        </div>
    </nav>
</template>

<script>
    export default {
        name: "Nav-bar",
        methods: {
            logOut(event){
                event.preventDefault();
                this.$store.dispatch('logOut').then(() => this.$router.push({name: "home"}));
            }
        },
        computed: {
            currentUser(){
               return this.$store.getters.getUserFromState;
            },
            isLoggedIn(){
                return this.$store.getters.getLoginStatus.loggedIn;
            }
        },
        mounted() {
            this.$store.dispatch('getUser');
        }
    }
</script>

<style scoped>

</style>