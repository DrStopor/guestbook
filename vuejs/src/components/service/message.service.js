import httpClient from "./http.service";

/**
 * Created by TheCodeholic on 3/7/2020.
 */
const messagesService = {
    create(theme, user_name, text) {
        return httpClient.post(`http://localhost:8080/api/message/save-message?theme=${theme}&author=${user_name}&text=${text}`)
    },
    get(page) {
        return httpClient.get(`http://localhost:8080/api/message/get-by-page?page=${page}`);
    },
    getPagesCount() {
        return httpClient.get('http://localhost:8080/api/message/pages-count');
    },
    getAllMessage() {
        return httpClient.get('http://localhost:8080/api/message/all');
    }
};

export default messagesService;