<template>
    <div>
        <h1>Welcome to your Dashboard <span class="text-capitalize">{{user.username}}</span> </h1>
    </div>
</template>

<script>
    export default {
        name: "DashboardComponent",
        data: function(){
          return {
              'user': {}
          }
        },
        computed: {
            getUserData() {
                this.user = this.$store.getters.getUserFromState;
            },
        },
        components: {},
        mounted() {
            this.user = localStorage.getItem('user');
            // console.log(this.user);
            this.$store.dispatch("getUser")
                .then(response => console.log(response))
                .catch(error=> console.log("unsuccessful"));
        }
    }
</script>

<style scoped>

</style>