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
         * Дергаем значение,
         * в теории могло помочь для перезагрузки компонента. По факту не помогло (либо не корректно реализовано)
         * @param ctx
         * @returns {Promise<void>}
         */
        async pokeWatchKey(ctx) {
            ctx.commit('incrementWatchKey');
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
         * Увеличение значения watchKey
         * @param state
         */
        incrementWatchKey (state) {
            state.watchKey++;
        }
    },
    state: {
        messages: [],
        watchKey: 0,
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
        watchKey(state) {
            return state.watchKey;
        }
    }
}