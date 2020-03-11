
class DataService {
    authHeader(){
        let token = localStorage.getItem('token');
        return token ? {
            'Content-Type': 'application/json',
            'Authorization': token
        } : {};
    }
}

export default new DataService();