import messageService from "../../components/service/message.service";

export default {
    actions: {
        async fetchMessages(ctx) {
            const {data} = await messageService.getAllMessage();
            ctx.commit('updateMessages', data)
        },
        async getByPage(ctx, page = 1) {
            const {data} = await messageService.get(page);
            ctx.commit('updateMessages', data);
        },
        async fetchPageCount(ctx) {
            const {data} = await messageService.getPagesCount();
            ctx.commit('setPageCount', data);
        },
        async pokeWatchKey(ctx) {
            ctx.commit('incrementWatchKey');
        }
    },
    mutations: {
        updateMessages(state, messages) {
            state.messages = messages;
        },
        setStateSendedMessage(state, isSend) {
            state.addedMessage = isSend;
        },
        setPageCount(state, pages) {
            state.pageCount = pages;
        },
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
        messagesCount(state) {
            return state.messages.length;
        },
        getMessagesByPage(state) {
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