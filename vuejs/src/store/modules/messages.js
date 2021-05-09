import messageService from "../../components/service/message.service";

export default {
    actions: {
        /**
         * Запрос всех сообщений из API
         * @param ctx
         * @returns {Promise<void>}
         */
        async fetchMessages(ctx) {
            const {data} = await messageService.getAllMessage();
            ctx.commit('updateMessages', data)
        },
        /**
         * Запрос сообщений для номерной страницы
         * @param ctx
         * @param page
         * @returns {Promise<void>}
         */
        async getByPage(ctx, page = 1) {
            const {data} = await messageService.get(page);
            ctx.commit('updateMessages', data);
        },
        /**
         * Запрос кол-ва страниц
         * @param ctx
         * @returns {Promise<void>}
         */
        async fetchPageCount(ctx) {
            const {data} = await messageService.getPagesCount();
            ctx.commit('setPageCount', data);
        },
        /**
         * Удаление сообщения по ID и пересборка сообщений на текущей странице
         * @param ctx
         * @param id
         * @returns {Promise<void>}
         */
        async delete(ctx, id) {
            await messageService.deleteMessage(id);
            const {data} = await messageService.get(ctx.state.page);
            ctx.commit('updateMessages', data);
        },
        /**
         * Запись страницы в state.page
         * @param ctx
         * @param page
         * @returns {Promise<void>}
         */
        async storePage(ctx, page) {
            ctx.commit('changeStorePage', page);
        },
        /**
         * Обновление сообщений на текущей странице
         * @param ctx
         * @returns {Promise<void>}
         */
        async justUpdateMessages(ctx) {
            const {data} = await messageService.get(ctx.state.page);
            ctx.commit('updateMessages', data);
        }
    },
    mutations: {
        /**
         * Изменяем значение message
         * @param state
         * @param messages
         */
        updateMessages(state, messages) {
            state.messages = messages;
        },
        /**
         * Установка значения флага addedMessage
         * @param state
         * @param isSend
         */
        setStateSendedMessage(state, isSend) {
            state.addedMessage = isSend;
        },
        /**
         * Установка значения pageCount кол-во страниц, для пагинации
         * @param state
         * @param pages
         */
        setPageCount(state, pages) {
            state.pageCount = pages;
        },
        /**
         * Изменение значения state.page
         * @param state
         * @param page
         */
        changeStorePage(state, page) {
            state.page = page;
        }
    },
    state: {
        messages: [],
        pageCount: 1,
        page: 1,
    },
    getters: {
        messages(state) {
            return state.messages;
        },
        pageCount(state) {
            return state.pageCount;
        },
        page(state) {
            return state.page;
        }
    }
}