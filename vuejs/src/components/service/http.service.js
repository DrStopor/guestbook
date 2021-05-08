import axios from "axios";
import authService from "./auth.service";

//const API_ENDPOINT = process.env.VUE_APP_API_ENDPOINT || 'http://localhost:8080/';
let config = {
    baseUrl: 'http://localhost:8080/api'
};

const httpClient = axios.create(config);

const authInterceptor = config => {
    authService.initToken();
    config.headers.Authorization = `Bearer ${authService.getToken()}`;
    return config;
};

httpClient.interceptors.request.use(authInterceptor);

httpClient.interceptors.response.use(
    response => {
        return response;
    },
    error => {
        if (error.response.status === 401) {
            return error;
        }
        return Promise.reject(error);
    }
)

export default httpClient;