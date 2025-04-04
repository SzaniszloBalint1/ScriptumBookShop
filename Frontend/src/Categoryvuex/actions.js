import { http } from "@/utils/http"

export default{
    async getCategories({commit}){
        try{
            const response=await http.get('/categories');
            commit('setCategory',response.data.data);
           return true;
        }
        catch(error){
            console.log('Sikertelen categoria lekérés',error);
            return false;
        }
    },
    async getCategoryId({commit},id){
        try{
            const response=await http.get(`/categories/${id}`);
            commit('setCategoryId',response.data.data);
            return true;
        }
        catch(error){
            console.log('Nincs találat a categória id-ra',error);
            return false;
        }
      
    }
}
