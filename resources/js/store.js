export default{
    state: {
        lastSearch:{
            from: null,
            to: null
        },
        basket:{
            items:[]
        }
    },

    mutations:{
        setLastSearch(state, payload){
            state.lastSearch = payload;
        },
        addToBasket(state, payload){
            state.basket.items.push(payload);
        },
        removeFromBasket(state, payload){
            state.basket.items = state.basket.items.filter(item => item.bookable.id !== payload);
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
    },
    getters:{
        itemsInBasket: (state) => state.basket.items.length,
        inBasketAlready(state){
            return function(id){
                return state.basket.items.reduce(
                    (result, item)=> result || item.bookable.id === id,
                  false
                  );
            }
        }
    }
};