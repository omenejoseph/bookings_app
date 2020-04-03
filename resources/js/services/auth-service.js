import DataService from './data-service';
class AuthService {

    login(user){
        return axios.post('login', {... user})
        .then(response => {
            localStorage.setItem('token', 'Bearer ' + response.data.data.token);
            return response.data.data.user;
        })
        .catch((error) => Promise.reject(error));
    }

    logOut(){
        return Promise.resolve(localStorage.removeItem('token'));
    }

    register(user, type){
        return axios.post('user', {... user})
            .then(response => {
                return  (type == 'register') ? this.login(user) : user;
            })
            .catch((error) => Promise.reject(error));
    }

    getAuthUser(){
        return axios.post('get-auth-user', {}, {
            headers: DataService.authHeader()
        })
        .then(response => {
            return response.data.data;
        });
    }
}

export default new AuthService();