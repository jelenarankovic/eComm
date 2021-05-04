export default{
    state: {
        lastSearch:{
            from: null,
            to: null
        }
    },

    mutations:{
        setLastSearch(state, payload){
            state.lastSearch = payload;
        }
    },
    actions: {
        //okej ovo se koristi da bismo zapamtili datume i nakon sto se rifresuje stranica, i cuvaju se u lokal storidzu
        setLastSearch(context, payload) {
            context.commit('setLastSearch', payload); 
            localStorage.setItem('lastSearch', JSON.stringify(payload));
        },
        loadStoredState(context) {
            const lastSearch = localStorage.getItem('lastSearch');
            if (lastSearch) {
                context.commit('setLastSearch', JSON.parse(lastSearch));
            }
        }
    }
};