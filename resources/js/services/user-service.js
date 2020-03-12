import DataService from "./data-service";


class UserService{
    getUsers(){
        return axios.post('users', {}, {
            headers: DataService.authHeader()
        })
            .then(response => {
                return response.data.data;
            })
            .catch((error) => Promise.reject(error));
    }
}
export default new UserService();