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
                            <input v-model="formData.password" type="password" class="form-control" placeholder="Password">
                        </div>
                        <div @click="submit()" class="btn btn-outline-primary btn-block">Submit</div>
                    </form>
                    <div class="d-flex flex-row-reverse pt-3">
                        <h4>Not a member <a href="#" @click="switchToRegister">Register here</a></h4>
                    </div>
                </div>
               <div class="register" v-if="!login">
                   <form action="" class="form">
                       <div class="form-group">
                           <label for="">First Name</label>
                           <div v-if="errors.first_name" class="text-danger">{{errors.first_name}}</div>
                           <input v-model="formData.first_name" type="text" class="form-control" placeholder="First Name">
                       </div>
                       <div class="form-group">
                           <label for="">Last Name</label>
                           <div v-if="errors.last_name" class="text-danger">{{errors.last_name}}</div>
                           <input v-model="formData.last_name" type="text" class="form-control" placeholder="Last Name">
                       </div>
                       <div class="form-group">
                           <label for="">Username</label>
                           <div v-if="errors.username" class="text-danger">{{errors.username}}</div>
                           <input v-model="formData.username" type="text" class="form-control" placeholder="Username">
                       </div>
                       <div class="form-group">
                           <label for="">Email</label>
                           <div v-if="errors.email" class="text-danger">{{errors.email}}</div>
                           <input v-model="formData.email" type="email" class="form-control" placeholder="Email">
                       </div>
                       <div class="form-group">
                           <label for="">Password</label>
                           <div v-if="errors.password" class="text-danger">{{errors.password}}</div>
                           <input v-model="formData.password" type="password" class="form-control" placeholder="Password">
                       </div>
                       <div class="form-group">
                           <label for="">Confirm Password</label>
                           <div v-if="errors.password_confirmation" class="text-danger">{{errors.password_confirmation}}</div>
                           <input v-model="formData.password_confirmation" type="password" class="form-control" placeholder="Retype Password">
                       </div>
                       <div class="form-group">
                           <label for="">Gender</label>
                           <div v-if="errors.gender" class="text-danger">{{errors.gender}}</div>
                           <select class="form-control" v-model="formData.gender">
                               <option value="male">Male</option>
                               <option value="female">Female</option>
                           </select>
                       </div>
                       <div class="form-group">
                           <label for="">Title</label>
                           <div v-if="errors.title" class="text-danger">{{errors.title}}</div>
                           <select class="form-control" v-model="formData.title">
                               <option value="mr">Mr</option>
                               <option value="mrs">Mrs</option>
                               <option value="miss">Miss</option>
                           </select>
                       </div>
                       <div class="form-group">
                           <label for="">Phone</label>
                           <div v-if="errors.phone" class="text-danger">{{errors.phone}}</div>
                           <input v-model="formData.phone" type="tel" class="form-control" placeholder="Phone Number">
                       </div>
                       <div @click="register" class="btn btn-outline-primary btn-block">Submit</div>
                   </form>
                   <div class="d-flex flex-row-reverse pt-3">
                       <h4>Already a member <a href="#" @click="switchToLogin">Login</a></h4>
                   </div>
               </div>
               </div>
            </div>
        </div>
    </div>

</template>

<script>
    import NavBar from "./elements/Nav-bar";
    export default {
        name: "HomeComponent",
        components: {NavBar},
        mounted() {},
        computed: {},
        data() {
            return {
                formData: {},
                errors: {},
                errorString: "",
                user: {},
                login: true,
            }
        },
        methods:{
            submit: function(){
                this.clearErrors();
                this.$store.dispatch('login', this.formData)
                    .then(() => this.$router.push({name: "dashboard"}))
                    .catch((error) => {
                        console.log(error);
                        this.handleErrorsObject(error);
                    });
            },
            register: function(){
                this.clearErrors();
                this.formData.role = "user";
                this.$store.dispatch('register', this.formData)
                    .then(()=>{
                        let loggedInState = this.$store.getters.getLoginStatus;
                        if (loggedInState.loggedIn){
                            this.$router.push({name: 'dashboard'});
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                        this.handleErrorsObject(error);
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
            handleErrorsObject: function (error) {
                const serverError = error.response.data;
                console.log(serverError);
                this.errorString = "You have some errors in your form";
                this.errors.username = serverError.errors.username[0];
                this.errors.password = serverError.errors.password[0];
                if (!this.login){
                    this.errors.first_name = serverError.errors.first_name[0];
                    this.errors.last_name = serverError.errors.last_name[0];
                    this.errors.email = serverError.errors.email[0];
                    this.errors.phone = serverError.errors.phone[0];
                    this.errors.gender = serverError.errors.gender[0];
                    this.errors.title = serverError.errors.title[0];
                }
            },
            clearErrors: function () {
                this.errors = {};
                this.errorString = "";
            }
        }
    }
</script>

<style scoped>

</style>