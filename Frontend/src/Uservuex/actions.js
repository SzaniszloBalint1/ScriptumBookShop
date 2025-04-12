import { http } from "@/utils/http"

export default {
  async user({commit}){
    try{
      const token = localStorage.getItem("token");
      if (token) {
        http.defaults.headers.common["Authorization"] = `Bearer ${token}`;
        const response=await http.get('/user');
        commit('setUser',response.data.data);
        console.log("User adatok lekérve",response.data.data);
      }else {
        console.error("Nincs token, kérlek jelentkezz be");
      }
     
    }catch(error){
      console.log("Valami hiba lépett fel",error);
      if (error.response) {
        console.error("Válasz adat:", error.response.data);
        console.error("Válasz státuszkód:", error.response.status);
      }
    }
  },
  async fetchUsers({ commit }) {
    try {
      const response = await http.get('/users'); 
      commit('setUsers', response.data.data);
      console.log("Összes user adatok lekérve", response.data.data);
    } catch (error) {
      console.log("Valami hiba lépett fel", error);
      if (error.response) {
        console.error("Válasz adat:", error.response.data);
        console.error("Válasz státuszkód:", error.response.status);
      }
    }
  },

    async updateRole({ commit }, userdata) {
      try {
        const response = await http.put(`/users/${userdata.id}/role`, {role: userdata.role});
        commit('updateRole', response.data.user);
        console.log("User sikeresen hozzáadva", response.data.user);
        return true;
      } catch (error) {
        console.error("Hiba történt a user hozzáadásakor", error);
        if (error.response) {
          console.error("Response data:", error.response.data);
        }
        return false; 
      } 
    },

  async registerUser({ commit }, userdata) {
    try {
        await http.get("/sanctum/csrf-cookie"); 
        const response = await http.post('/register', userdata);
        
        if (response.data.success) {
          localStorage.setItem("token", response.data.token);
          http.defaults.headers.common["Authorization"] = `Bearer ${response.data.token}`;
            commit("setUser", response.data.data);
            return true;
        } else {
            console.error("Hiba: Nem érkezett token a válaszból!");
            return false;
        }
    } catch (error) {
        console.error("Hiba történt a regisztrációkor", error);
        if (error.response) {
          console.error("Response data:", error.response.data);
        }
      }
},
    
async loginUser({ commit,dispatch }, { email, password }) {
  try {
      await http.get("/sanctum/csrf-cookie"); 
      const response = await http.post("/login", { email, password });

      if (response.data.token) {
          localStorage.setItem("token", response.data.token);
          http.defaults.headers.common["Authorization"] = `Bearer ${response.data.token}`;
          commit("setUser", response.data.data);
         await dispatch('user');
          return true;
      } else {
          console.error("Hiba: Nem érkezett token a válaszból!");
          return false;
      }
  } catch (error) {
      console.error("Hiba történt a bejelentkezéskor", error);
      if (error.response) {
          console.error("Response data:", error.response.data);
      }
      return false; 
  }
},
    
      async logoutUser({ commit }) {
        try {
          await http.post('/logout');
          localStorage.removeItem('token');
          delete http.defaults.headers.common['Authorization'];
          commit('cleanUser', null);
        } catch (error) {
          console.error('Hiba történt a kijelentkezéskor', error);
        }
      },

     async sendMail({commit},{email}){
         try{
           const response=http.post('/email/verification-notification',{email});
           console.log("Email elküldve",response.data.data);
           commit('setEmail',response.data.data);
         }catch(error){
             console.log("Valami hiba lépett fel",error);
             if (error.response) {
             console.error("Válasz adat:", error.response.data);
             console.error("Válasz státuszkód:", error.response.status);
            }
         }
     },

     async PasswordResetEmail({commit},{email}){
      try{
        const response=await http.post('/forget-password',{email});
        console.log("Email elküldve",response.data.data);
        commit('setEmail',response.data.data);
        return true;
      }catch(error){
          console.log("Valami hiba lépett fel",error);
          if (error.response) {
          console.error("Válasz adat:", error.response.data);
          console.error("Válasz státuszkód:", error.response.status);
         }
         return false;
      }
     },
     async PasswordReset({commit},{email,password,password_confirmation,token}){
      try{
        const response=await http.post('/reset-password',{email,password,password_confirmation,token});
        console.log("Jelszó visszaállítva",response.data.data);
        commit('setEmail',response.data.data);
        return true;
      }catch(error){
          console.log("Valami hiba lépett fel",error);
          if (error.response) {
          console.error("Válasz adat:", error.response.data);
          console.error("Válasz státuszkód:", error.response.status);
         }
         return false;
     }
    },
    async updateUserData({commit}, userData){
      try{
        
        console.log("Küldendő adatok:", userData);
        
        const response = await http.put(`/users/${userData.id}`, {
          username: userData.username, 
          email: userData.email,
          PhoneNumber: userData.PhoneNumber
        });
        
        if (response.data && response.data.data) {
          commit('setUser', response.data.data);
          const userResponse = await http.get('/user');
          if (userResponse.data) {
            commit('setUser', userResponse.data);
           
          }
          
          return true;
        } else {
        
          return false;
        }
      } catch(error) {
      
        if (error.response) {
    
        }
        return false;
      }
    },
}