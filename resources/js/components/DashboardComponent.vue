<template>
    <div>
        <h1>Welcome to your Dashboard <span class="text-capitalize">
            {{currentUser.username}}
        </span> </h1>
    </div>
</template>

<script>
    export default {
        name: "DashboardComponent",
        data: function(){
          return {
              user: {}
          }
        },
        computed: {
            currentUser() {
                return this.$store.getters.getUserFromState;
            }
        },
        components: {},
        mounted: {},
        methods: {}
    }
</script>

<style scoped>

</style>