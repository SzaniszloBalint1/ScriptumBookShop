import getters from './getters';
import actions from './actions';
import mutations from './mutations';

export default{
    namespaced:true,
    state(){
        return{
            books:[],
            bookId: null,
            search:"",
            mostviewedbooks:[],
            latestbooks:[],
            newestbooks:[],
            mostcommentedbooks:[],
            mostlikedbooks:[],
            authorBooks: []
        };
    },
    getters,
    actions,
    mutations
    
}