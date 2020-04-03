import DataService from './data-service';
class BookingService {
    listBookings(){
        return axios.post('get-bookings', {}, {
            headers: DataService.authHeader()
        })
        .then(response => {
            return response.data.data;
        })
        .catch((error) => Promise.reject(error));
    }

    createBooking(formData){
        return axios.post('booking', {...formData}, {
                    headers: DataService.authHeader()
                })
                .then(response => {
                    return response.data.data;
                })
                .catch((error) => Promise.reject(error));
    }

    viewBooking(id){
        return axios.post('booking/' + id)
            .then(response => {
                return response.data.data;
            })
            .catch((error) => Promise.reject(error));
    }
}

export default new BookingService();