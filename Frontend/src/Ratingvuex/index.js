 import actions from './actions';
 import mutations from './mutations';
 import getters from './getters';


 export default {
    namespaced:true,
    state(){
        return{
            ratings:[],          
            userRatings:{},       
            hoverRating:0,        
            selectedRating: 0,     
            isSubmitting: false,   
            currentBookId: null  
        };
    },
    actions,
    mutations,
    getters
 }
