
class DataService {
    authHeader(){
        let token = localStorage.getItem('token');
        return token ? {
            'Content-Type': 'application/json',
            'Authorization': token
        } : {};
    }

    handleErrorsObject(errors, type){
        const serverError = errors.response.data;
        console.log(errors);
        let errorString = "You have some errors in your form";
        let error_object = {};
        error_object.username = serverError.errors.username[0];
        error_object.password = serverError.errors.password[0];
        if (type == 'register') {
            error_object.first_name = serverError.errors.first_name[0];
            error_object.last_name = serverError.errors.last_name[0];
            error_object.email = serverError.errors.email[0];
            error_object.phone = serverError.errors.phone[0];
            error_object.gender = serverError.errors.gender[0];
            error_object.title = serverError.errors.title[0];
        }
        return error_object;
    }
}

export default new DataService();