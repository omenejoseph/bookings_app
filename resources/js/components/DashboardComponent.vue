<template>
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h1 class="page-header pb-4 text-center pt-3">Welcome to your Dashboard</h1>

                    <div class="row placeholders justify-content-between">
                        <div class="col-xs-6 col-sm-3 placeholder">
                            <a href="#" @click="iWantToViewBookings">
                                <div>
                                    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="50" height="50" class="img-responsive" alt="Generic placeholder thumbnail">
                                    <p v-if="bookingsList" class="counter">{{bookingsList.length}}</p>
                                    <h4>Bookings</h4>
                                </div>
                            </a>
                            <span class="text-muted"><router-link :to="{name: 'create-booking'}">Add New Booking</router-link> </span>
                        </div>
                        <div class="col-xs-6 col-sm-3 placeholder">
                            <a href="" @click="iWantToViewUsers">
                                <div >
                                    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="50" height="50" class="img-responsive" alt="Generic placeholder thumbnail">
                                    <p v-if="usersList" class="counter">{{usersList.length}}</p>
                                    <h4>Users</h4>
                                </div>
                            </a>
                            <span class="text-muted"><router-link :to="{name: 'create-user'}">Add New User</router-link> </span>
                        </div>
                    </div>
                    <div v-if="viewBookings">
                        <h2 class="sub-header">Bookings</h2>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>title</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(booking, index) in bookingsList" :key="booking.id">
                                    <td>{{index + 1}}</td>
                                    <td>{{booking.title}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <router-link class="dropdown-item" :to="{name: 'update-booking', params: {id: booking.id}}">Update</router-link>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div v-if="viewUsers">
                        <h2 class="sub-header">Users</h2>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>title</th>
                                    <th>name</th>
                                    <th>username</th>
                                    <th>email</th>
                                    <th>phone</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(user, index) in usersList" :key="user.id">
                                    <td>{{index + 1}}</td>
                                    <td>{{user.title}}</td>
                                    <td>{{user.first_name + " " + user.last_name}}</td>
                                    <td>{{user.username}}</td>
                                    <td>{{user.email}}</td>
                                    <td>{{user.phone}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Update</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "DashboardComponent",
        data: function(){
          return {
              user: {},
              viewBookings: true,
              viewUsers: false,
          }
        },
        props: {
          users: Boolean
        },
        computed: {
            currentUser() {
                return this.$store.getters.getUserFromState;
            },
            isLoggedIn(){
                return this.$store.getters.getLoginStatus.loggedIn;
            },
            bookingsList(){
                 return this.$store.getters.getBookingsList;
            },
            usersList(){
                 return this.$store.getters.getUsersList;
            }
        },
        components: {},
        mounted(){

        },
        methods: {
            iWantToViewUsers: function (event) {
                event.preventDefault();
                this.viewUsers =true;
                this.viewBookings =false;
            },
            iWantToViewBookings: function (event) {
                event.preventDefault();
                this.viewUsers =false;
                this.viewBookings =true;
            },
            resolveViewBookings(){
                return console.log(this.users ? this.viewBookings && !this.users : this.viewBookings);
            },
            resolveViewUsers(){
                return this.users ? this.viewUsers && this.users : this.viewUsers;
            }
        },
        created() {
            console.log(this.currentUser, this.isLoggedIn);
            if (this.currentUser == null && !this.isLoggedIn){
                this.$router.push({name: "home"});
            }
            if (this.bookingsList == null){
                this.$store.dispatch('getBookings');
            }
            if (this.usersList == null){
                this.$store.dispatch('getUsers');
            }
        }
    }
</script>

<style scoped>
    .placeholders {
        margin-bottom: 30px;
        text-align: center;
    }
    .placeholders h4 {
        margin-bottom: 0;
    }
    .placeholder {
        margin-bottom: 20px;
    }
    .placeholder img {
        display: inline-block;
        border-radius: 50%;
    }
    .counter{
        padding: 0px;
        margin-top: -35px;
        color: white;
    }
</style>