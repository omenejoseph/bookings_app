
export function getUserFromApi(router = null){
    const headers = {
        'Content-Type': 'application/json',
        'Authorization': localStorage.getItem('token')
    };
    axios.post("get-auth-user", {}, {
        headers: headers
    }).then(function (response) {
        return  response.data.data;
    }).catch(function (error) {
        if (error.response.status == 403){
            localStorage.removeItem('token');
            router.push({name: "home"});
        }
        console.log(error.response);
    });
};