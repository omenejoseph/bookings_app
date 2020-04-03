<template>
    <div>
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
    </div>
</template>

<script>
    import DataService from '../../services/data-service';
    export default {
        name: "AddUserForm",
        data() {
            return{
                formData : {},
                errors: {},
            }
        },
        props: {
            type: String
        },
        methods: {
            register(event){
                event.preventDefault();
                this.formData.role = "user";
                this.formData.type = this.type;
                this.$store.dispatch('register', this.formData)
                    .then(()=>{

                        let loggedInState = this.$store.getters.getLoginStatus;
                        (loggedInState.loggedIn && this.type == 'register') ?
                            this.$router.push({name: 'dashboard'})
                            : this.$emit('userDataSubmitted', true);
                    })
                    .catch((error) => {
                        this.errors = DataService.handleErrorsObject(error, 'register');
                    });
            },
            created(){
                console.log(this.type);
            }
        }
    }
</script>

<style scoped>

</style>