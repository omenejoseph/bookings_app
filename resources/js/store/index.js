import AuthService from '../services/auth-service';

export default {
    state: {
        user: {},
        status: {}
    },
    getters: {
        getUserFromState(state){ //take parameter state
            return state.user
        }
    },
    actions: {
        getUser(context){
            return AuthService.getAuthUser()
                .then((user) => context.commit('foundUser', user))
                .catch(error => console.log(error));
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
        }
    },
    mutations: {
        foundUser(state, data) {
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
        }
    }

}