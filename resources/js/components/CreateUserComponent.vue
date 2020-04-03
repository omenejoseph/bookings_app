<template>
    <div>
        <back-button/>
        <div class="card">
            <div class="card-header"> <h3>Create User</h3></div>
            <div class="card-body">
                <add-user-form @userDataSubmitted="userCreated" :type="create"/>
            </div>
        </div>
    </div>
</template>

<script>
    import BackButton from "./elements/BackButton";
    import AddUserForm from "./elements/AddUserForm";
    export default {
        name: "CreateUserComponent",
        components: {AddUserForm, BackButton},
        methods: {
            userCreated(){
                this.$router.push({name: 'dashboard'})
            }
        },
        data(){
            return {
                create: "create"
            }
        }
    }
</script>

<style scoped>

</style>