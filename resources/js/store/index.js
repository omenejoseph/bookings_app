import AuthService from '../services/auth-service';
import BookingService from '../services/booking-service';
import UserService from '../services/user-service';


export default {
    state: {
        user: null,
        status: {loggedIn: false},
        bookings: null,
        users: null,
        currentBooking: null
    },
    getters: {
        getUserFromState(state){ //take parameter state
            return state.user
        },
        getLoginStatus(state){
            return state.status;
        },
        getBookingsList(state){
            return state.bookings;
        },
        getUsersList(state){
            return state.users;
        },
        getBookingFromState(state) {
            return state.currentBooking;
        }
    },
    actions: {
        getUser(context){
            return AuthService.getAuthUser()
                .then((user) => {
                    context.commit('foundUser', user)})
                .catch(error => {
                    console.log(error.response);
                    if (error.response.status == 403){
                        localStorage.removeItem('token');
                        context.commit('logout')
                    }
                });
        },
        login(context, formData){
            return AuthService.login({... formData})
                .then(user => {
                    context.commit('loginSuccessful', user);
                    return Promise.resolve(user);
                })
                .catch(error => {
                    context.commit('loginFailure');
                    return Promise.reject(error);
                });
        },
        register(context, formData){
            let type = formData.type;
            delete formData.type;
            return AuthService.register({... formData}, type)
                .then(user => {
                    if (type = 'register'){
                        context.commit('loginSuccessful', user);
                    }
                    return Promise.resolve(user);
                })
                .catch(error => {
                    context.commit('loginFailure');
                    return Promise.reject(error);
                });
        },
        logOut(context){
            return AuthService.logOut()
                .then(() => context.commit('logout'))
                .catch((error) => console.log(error));
        },
        getBookings(context){
            return BookingService.listBookings()
                .then((booking) => context.commit('bookings', booking))
                .catch((error) => console.log(error.response));
        },
        getUsers(context){
            return UserService.getUsers()
                .then((users) => context.commit('users', users))
                .catch((error) => {
                    if (error.response.status == 403){
                        this.logOut();
                    }
                });
        },
        getBooking(context, id){
            return BookingService.viewBooking(id)
                .then((booking) => context.commit('bookingFound', booking))
                .catch((error) => Promise.reject(error));
        },
        createBooking(context, formData){
            return BookingService.createBooking(formData)
                    .then((booking) => booking)
                    .catch((error) => Promise.reject(error));
        }
    },
    mutations: {
        foundUser(state, data) {
            state.status.loggedIn = true;
            state.user = data
        },
        loginSuccessful(state, user){
            state.status.loggedIn = true;
            state.user = user;
        },
        loginFailure(state) {
            state.status.loggedIn = false;
            state.user = null;
        },
        logout(state) {
            state.status.loggedIn = false;
            state.user = null;
        },
        registerSuccess(state) {
            state.status.loggedIn = false;
        },
        registerFailure(state) {
            state.status.loggedIn = false;
        },
        bookings(state, bookings){
            state.bookings = bookings;
        },
        users(state, users){
            state.users = users;
        },
        bookingFound(state, booking){
            state.currentBooking = booking;
        }
    }

}