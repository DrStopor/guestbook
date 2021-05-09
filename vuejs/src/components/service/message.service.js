import httpClient from "./http.service";

const API_ENDPOINT = process.env.VUE_APP_API_ENDPOINT || 'http://localhost:8080/';

/**
 * Created by TheCodeholic on 3/7/2020.
 */
const messagesService = {
    /**
     * Обращение к API для сохранения сообщения
     * @param theme
     * @param user_name
     * @param text
     * @returns {Promise<AxiosResponse<any>>}
     */
    create(theme, user_name, text) {
        return httpClient.post(`${API_ENDPOINT}api/message/save-message?theme=${theme}&author=${user_name}&text=${text}`)
    },
    /**
     * Получение от API контента для страницы
     * @param page
     * @returns {Promise<AxiosResponse<any>>}
     */
    get(page) {
        return httpClient.get(`${API_ENDPOINT}api/message/get-by-page?page=${page}`);
    },
    /**
     * Получение от API кол-ва страниц
     * @returns {Promise<AxiosResponse<any>>}
     */
    getPagesCount() {
        return httpClient.get(`${API_ENDPOINT}api/message/pages-count`);
    },
    /**
     * Получение всех сообщений от API
     * @returns {Promise<AxiosResponse<any>>}
     */
    getAllMessage() {
        return httpClient.get(`${API_ENDPOINT}api/message/all`);
    },
    deleteMessage(id) {
        return httpClient.delete(`${API_ENDPOINT}api/message/${id}`);
    }
};

export default messagesService;