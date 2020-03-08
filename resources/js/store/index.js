export default {
    state: {
        user: {},
    },
    getters: {
        getUserFromState(state){ //take parameter state
            return state.user
        }
    },
    actions: {
        getUser(context){
            const headers = {
                'Content-Type': 'application/json',
                'Authorization': localStorage.getItem('token')
            };

            axios.post("get-auth-user", {}, {
                headers: headers
            })
            .then((response)=>{
                context.commit("user", response.data.data);
            })
            .catch((error)=>{
                console.log(error.response);
            })
        }
    },
    mutations: {
        user(state, data) {
            return state.user = data
        }
    }

}