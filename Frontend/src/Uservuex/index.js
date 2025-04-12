import actions from "./actions";
import getters from "./getters";
import mutations from "./mutations";



export default {
    namespaced:true,
    state(){
        return{
            user:null,
            token:null,
            isAuth:false,
            users:[],
            userId:null,
            email:null,
            emailStatus: {
                status: null,
                message: null
            },
        }
    },
    actions,
    getters,
    mutations
}
