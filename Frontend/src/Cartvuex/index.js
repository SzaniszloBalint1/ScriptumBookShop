import actions from './actions';
import mutations from './mutations';
import getters from './getters';


export default {
    namespaced:true,
    state(){
        const storedCart=JSON.parse(localStorage.getItem('cart')) || [];
        return{
            cart:storedCart,
            book:null
        }
    },
    actions,
    mutations,
    getters
}