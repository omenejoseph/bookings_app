<template>
    <div>
        <back-button></back-button>

        <div class="col-md-offset-6">
            <div class="card">
                <div class="card-header"><h3>Booking create component</h3></div>
                <div class="card-body">
                    <form action="" class="">
                        <div class="form-group">
                            <label for="">Title</label>
                            <div  class="text-danger">{{titleError}}</div>
                            <input v-model="title" class="form-control" type="text" name="" id="" placeholder="title">
                        </div>
                        <button v-if="!booking" @click="createBooking" class="btn-outline-primary">Create</button>
                        <button v-else @click="updateBooking" class="btn-outline-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import BackButton from "./elements/BackButton";
    export default {
        name: "CreateBookingComponent",
        components: {BackButton},
        data(){
          return {
              title: null,
              errors: {},
              titleError: "",
              id: null
          }
        },
        created() {
            this.id = this.$route.params.id;
            this.$store.dispatch('getBooking', this.id);
        },
        methods: {
            createBooking(event){
                event.preventDefault();
                console.log(this.id);
                // this.$store.dispatch('createBooking', {title: this.title})
                //     .then(() => {
                //         this.$router.push({name: "dashboard"})
                //     })
                //     .catch((error) => {
                //         let serverError = error.response;
                //         this.titleError = serverError.data.errors.title[0];
                //     });
            },
            updateBooking(event){
                event.preventDefault();
            }
        },
        computed: {
            booking: function () {

            }
        }
    }
</script>

<style scoped>

</style>