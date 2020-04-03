<template>
    <div class="flex">
        <div class="card">
            <div class="card-header"><h4 v-if="login">Login</h4><h4 v-else>Register</h4></div>
            <div class="card-body justify-content-center">
                <div v-if="errorString" class="text-danger pl-5"></div>
                <div class="login" v-if="login">
                    <form action="" class="form">
                        <div class="form-group">
                            <label for="">Username</label>
                            <div v-if="errors.username" class="text-danger">{{errors.username}}</div>
                            <input v-model="formData.username" type="text" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <div v-if="errors.password" class="text-danger">{{errors.password}}</div>
                            <input @keyup.enter="submit" v-model="formData.password" type="password" class="form-control" placeholder="Password">
                        </div>
                        <div @click="submit" class="btn btn-outline-primary btn-block">Submit</div>
                    </form>
                    <div class="d-flex flex-row-reverse pt-3">
                        <h4>Not a member <a href="#" @click="switchToRegister">Register here</a></h4>
                    </div>
                </div>
               <div class="register" v-if="!login">
                   <add-user-form @userDataSubmitted="userRegistered" :type="type"/>
                   <div class="d-flex flex-row-reverse pt-3">
                       <h4>Already a member <a href="#" @click="switchToLogin">Login</a></h4>
                   </div>
               </div>
               </div>
            </div>
        </div>

</template>

<script>
    import NavBar from "./elements/Nav-bar";
    import AddUserForm from "./elements/AddUserForm";
    import DataService from "../services/data-service";

    export default {
        name: "HomeComponent",
        components: {AddUserForm, NavBar},
        mounted() {},
        computed: {},
        data() {
            return {
                formData: {},
                errors: {},
                errorString: "",
                user: {},
                login: true,
                type: "register"
            }
        },
        methods:{
            submit: function(){
                this.clearErrors();
                this.$store.dispatch('login', this.formData)
                    .then(() => this.$router.push({name: "dashboard"}))
                    .catch((error) => {
                        this.errors = DataService.handleErrorsObject(error);
                    });
            },
            switchToRegister: function (event) {
                event.preventDefault();
                this.login = false;
                this.formData = {};
            },
            switchToLogin: function (event) {
                event.preventDefault();
                this.login = true;
                this.formData = {};
            },
            clearErrors: function () {
                this.errors = {};
                this.errorString = "";
            },
            userRegistered(){
                let loggedInState = this.$store.getters.getLoginStatus;
                if (loggedInState.loggedIn){
                    this.$router.push({name: 'dashboard', params: {login : false}});
                }
            }
        }
    }
</script>

<style scoped>

</style>