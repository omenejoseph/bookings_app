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
        localStorage.removeItem('token');
    }

    register(user){
        return axios.post('user', {... user})
            .then(response => {
                return this.login(user);
            })
            .catch((error) => Promise.reject(error));
    }

    getAuthUser(){
        axios.post(' get-auth-user', {}, {
            headers: DataService.authHeader()
        })
        .then(response => {
            localStorage.setItem('token', 'Bearer ' + response.data.data.token);
            return response.data;
        });
    }
}

export default new AuthService();