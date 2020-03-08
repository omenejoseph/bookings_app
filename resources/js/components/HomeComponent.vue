<template>
    <div class="flex">
        <div class="card">
            <div class="card-header">Log Into Bookings App</div>
            <div class="card-body justify-content-center">
                <div v-if="errorString" class="text-danger pl-5">{{errorString}}</div>
                <form action="" class="form">
                    <div class="form-group">
                        <label for="">Username</label>
                        <div v-if="errors.username" class="text-danger">{{errors.username}}</div>
                        <input v-model="formData.username" type="text" class="form-control" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <div v-if="errors.password" class="text-danger">{{errors.username}}</div>
                        <input v-model="formData.password" type="password" class="form-control" placeholder="Password">
                    </div>
                    <div @click="submit()" class="btn btn-outline-primary btn-block">Submit</div>
                </form>
            </div>
        </div>
    </div>

</template>

<script>
    import NavBar from "./elements/Nav-bar";
    export default {
        name: "HomeComponent",
        components: {NavBar},
        mounted() {
            this.$store.dispatch("getUserFromState")
                .then(response => console.log("successful"))
                .catch(error=> console.log("unsuccessful"));
        },
        computed: {
            getUserData(){
                this.user =  this.$store.getters.getUserFromState;
                console.log(this.user);
            },
        },
        data() {
            return {
                formData: {},
                errors: {},
                errorString: "",
                user: {}
            }
        },
        methods:{
            submit: function(){
                this.errors = {};
                this.errorString = "";
                console.log("hello");
                axios.post('login', {
                    username: this.formData.username,
                    password: this.formData.password
                })
                .then(response => {
                    localStorage.setItem('token', 'Bearer ' + response.data.data.token);
                    localStorage.setItem('user', response.data.data.user);
                    this.$router.push({name: 'dashboard'});
                    console.log(response);
                })
                .catch((error) => {
                    const serverError =error.response.data;
                    this.errorString = serverError.message;
                    this.errors.username = serverError.errors.username[0];
                    this.errors.password = serverError.errors.password[0];
                    // console.log(error)
                })
            }
        }
    }
</script>

<style scoped>

</style>