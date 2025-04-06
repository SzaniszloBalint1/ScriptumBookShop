import { http } from "@/utils/http"

export default {
    async getComments({commit}){
        try{
            const reponse=await http.get('/comments');
            commit('setComments',reponse.data.data);
            console.log("Commentek lekérve",reponse.data.data);
            return true;
        }catch(error){
            console.log("Valami hiba történt",error);
            if (error.response) {
            
                console.error("Válasz adat:", error.response.data.data);
                console.error("Válasz státuszkód:", error.response.status);
            }
            return false;
        }
    },
    async addComment({commit},commentData){
        try{
            const response = await http.post('/comments', commentData);
            if (!response.data.data && commentData.user_id) {
                const currentUser = this.getters["user/user"];
                if (currentUser && currentUser.id === commentData.user_id) {
                    response.data.data = currentUser;
                }
            }
            
            commit('addComment',response.data.data);
            console.log("Comment sikeresen hozzáadva",response.data.data);
            return true;
        }catch(error){
            console.log("Valami hiba történt",error);
            if (error.response) {
            
                console.error("Válasz adat:", error.response.data.data);
                console.error("Válasz státuszkód:", error.response.status);
            }
            return false;
        }
    },
    async getCommentId({commit},id){
        try{
            const response=await http.get(`/comments/${id}`);
            commit('setCommentId',response.data.data);
            console.log("Comment lekérve",response.data.data);
            return true;
        }catch(error){
            console.log("Valami hiba történt",error);
            if (error.response) {
            
                console.error("Válasz adat:", error.response.data.data);
                console.error("Válasz státuszkód:", error.response.status);
            }
            return false;
        }
    },

    async UpdateComment({commit},comment){  
        try{
            const response=await http.put(`/comments/${comment.id}`,comment);
            commit('updateCommentId',response.data);
            console.log("Comment sikeresen frissítve",response.data);
            return true;
        }catch(error){
            console.log("Valami hiba történt",error);
            if (error.response) {
            
                console.error("Válasz adat:", error.response.data);
                console.error("Válasz státuszkód:", error.response.status);
            }
            return false;
        }
    },

    async deleteComment({commit},id){
        try{
            const response=await http.delete(`/comments/${id}`);
            commit('deleteCommentId',response.data);
            console.log("Comment sikeresen törölve",response.data);
            return true;
        }catch(error){
            console.log("Valami hiba történt",error);
            if (error.response) {
            
                console.error("Válasz adat:", error.response.data);
                console.error("Válasz státuszkód:", error.response.status);
            }
            return false;
        }
    }
   
}