<template>
    <div class="pb-2 pt-3">
        <a href="#" @click="returnBack"><< Back</a>
    </div>
</template>

<script>
    export default {
        name: "BackButton",
        methods: {
            returnBack(){
                this.$router.back();
            }
        }
    }
</script>

<style scoped>

</style>