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
}

export default new BookingService();