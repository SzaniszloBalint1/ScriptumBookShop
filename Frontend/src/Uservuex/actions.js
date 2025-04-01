import { http } from "@/utils/http"

export default{
    
        async getData({commit}){
            try{
                const response=await http.get('/books');
                commit('setBooks',response.data.data);
                return true;
            }catch(error){
                console.error('Nem történt fetch',error);
                return false;
            }
        },
        async getDataId({commit},id){
            try{
                const response=await http.get(`/books/${id}`);
                commit('setBookId',response.data.data);
                return true;
            }
            catch(error){
                console.error('Nem történt fetch',error);
                return false;
            }
           
        },
        async newBook({commit,dispatch},book){
            try{
                const response=await http.post('/books',book);
                commit('newBook',response.data.data);
                await dispatch('getData');
                return true;
            }catch(error){
                console.error('Nem történt hozzáadás',error);
                return false;
            }
        },


        async updateBook({commit,dispatch},book){
            try{
                const response=await http.put(`/books/${book.id}`,book);
                commit('updateBook',response.data.data);
                await dispatch('getData');
                return true;
            }
            catch(error){
                console.error('Nem történt update',error);
                return false;
            }
        },

        async deleteBook({commit},id){
            try{ 
               await http.delete(`/books/${id}`);
                commit('deleteBook',id);
                return true;
            }catch(error){
                console.error('Nem történt törlés',error);
                return false;
            }
        },
      


        async incrementViewCounter({commit,dispatch},id){
            try{
                await http.post(`/books/${id}/view`); 
                await dispatch('fetchMostViewedBooks');  
        commit('incrementViewCounter', id);
        return true;
            }
            catch(error){
                console.error('Nem történt növelés',error);
                return false;
            }
        },

        async fetchMostViewedBooks({commit}){
            try{
                const response=await http.get('/books/most-viewed');
                commit('setMostViewedBooks',response.data.data);
                return true;
            }
            catch(error){
                console.error('Nem történt fetch',error);
                return false;
            }
        },

        async getLatestBooks({commit}){
            try{
                const response=await http.get('/books/oldest-books');
                commit('setLatestBooks',response.data.data);
                return true;
            }
            catch(error){
                console.log(response.error);
                return false;
            }
          
        },
        async getNewestBooks({commit}){
            try{
                const response=await http.get('/books/newest-books');
                commit('setNewestBooks',response.data.data);
                return true;
            }
            catch(error){
                console.log(response.error);
                return false;
            }
          
        },
        async getMostCommentedBooks({commit}){
            try{
                const response=await http.get('/books/most-commented');
                commit('setMostCommentedBooks',response.data.data);
                return true;
            }
            catch(error){
                console.log(response.error);
                return false;
            }
          
        },
      
        async updateBookRating({ commit }, bookId) {
            try {
                const response = await http.get(`/books/${bookId}`);
                commit('updateBook', response.data.data);
                return true;
            } catch(error) {
                console.error('Hiba a könyv értékelésének frissítésekor:', error);
                return false;
            }
        },

        async getMostLikedRating({commit}){
            try{
                const response=await http.get('/books/most-liked');
                commit('setMostLikedRating',response.data.data);
            }
            catch(error){
                console.log(response.error);
            }
        },
        async getBooksByAuthor({commit}, author) {
            if (!author) {
                commit('setAuthorBooks', []);
                return false;
            }
            try {
                const response = await http.get(`/books/author/${encodeURIComponent(author)}`);
                console.log('API válasz:', response.data.data); 
                commit('setAuthorBooks',response.data.data);
                return true;
            } catch(error) {
                console.error('Hiba történt a szerző könyveinek betöltésekor:', error);
                commit('setAuthorBooks', []);
                return false;
            } 
        }
    
}
       

