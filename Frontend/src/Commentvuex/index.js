import getters from "./getters"
import actions  from "./actions"
import mutations from "./mutations"
export default {
    namespaced:true,
    state(){
        return{
            comments:[],
            loading:false,
            error:null,
            commentId:null
        }
    },
    getters,
    actions,
    mutations
}
