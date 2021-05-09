import httpClient from "./http.service";

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
        return httpClient.post(`http://localhost:8080/api/message/save-message?theme=${theme}&author=${user_name}&text=${text}`)
    },
    /**
     * Получение от API контента для страницы
     * @param page
     * @returns {Promise<AxiosResponse<any>>}
     */
    get(page) {
        return httpClient.get(`http://localhost:8080/api/message/get-by-page?page=${page}`);
    },
    /**
     * Получение от API кол-ва страниц
     * @returns {Promise<AxiosResponse<any>>}
     */
    getPagesCount() {
        return httpClient.get('http://localhost:8080/api/message/pages-count');
    },
    /**
     * Получение всех сообщений от API
     * @returns {Promise<AxiosResponse<any>>}
     */
    getAllMessage() {
        return httpClient.get('http://localhost:8080/api/message/all');
    }
};

export default messagesService;