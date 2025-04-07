import { http } from "@/utils/http"

export default {
   
    async getRatings({commit}){
        try{
            const response = await http.get("/rating");
            commit("setRatings", response.data.data);
            return response.data;
        }
        catch(error){
            console.error('Hiba az értékelések lekérésekor:', error);
            throw error;
        }
    },
    
   
    async getUserRatings({commit}){
        try{
            const user = this.getters["user/user"];
            if (!user) return;
            const response = await http.get("/rating");
            const userRatings = response.data.data.filter(r => r.user_id === user.id);
            commit("setUserRatings", userRatings);
            return userRatings;
        }
        catch(error){
            console.error('Hiba a felhasználó értékeléseinek lekérésekor:', error);
            throw error;
        }
    },
    

    async getBookRatings({commit},bookId){
        try{
            const response = await http.get("/rating");
            const bookRatings =response.data.data.filter(r => r.book_id == bookId);
            return bookRatings;
        }
        catch(error){
            console.error('Hiba a könyv értékeléseinek lekérésekor:', error);
            throw error;
        }
    },

   
    async addRating({commit, dispatch}, ratingData){
        try{
            const response = await http.post("/rating", ratingData);
            commit("addRating", response.data.data);
           
            dispatch('book/updateBookRating', ratingData.book_id, {root: true});
            return response.data.data;
        }
        catch(error){
            console.error('Hiba az értékelés hozzáadásakor:', error);
            throw error;
        }
    },

   
    async deleteRating({commit}, id){
        try{
            await http.delete(`/rating/${id}`);
            commit("deleteRating", id);
            return true;
        }
        catch(error){
            console.error('Hiba az értékelés törlésekor:', error);
            throw error;
        }
    },


    async updateRating({commit}, rating){
        try{
            const response = await http.put(`/rating/${rating.id}`, rating);
            commit("updateRating", response.data.data);
            return response.data.data;
        }
        catch(error){
            console.error('Hiba az értékelés frissítésekor:', error);
            throw error;
        }
    }
}