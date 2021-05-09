/**
 * Хардкоженный токен
 * @type {string}
 */
const token = process.VUE_APP_API_TOKEN;

const authService = {
    initToken() {
        return localStorage.setItem('ACCESS_TOKEN', token);
    },
    getToken() {
        return localStorage.getItem('ACCESS_TOKEN');
    }
}

export default authService;