import { http } from "@/utils/http";

export default {
  saveUserData({ commit }, userData) {
    console.log("Felhasználói adatok mentése:", userData);
    commit("SET_ORDER_DATA", userData);
    return true;
  },
  
  setOrderStep({ commit }, step) {
    commit("SET_ORDER_STEP", step);
    return true;
  },
  async confirmOrder({ commit, state, rootGetters }) {
    commit("SET_LOADING", true);
    
    try {
      console.log("Rendelés feldolgozása kezdődik");
      console.log("Kosár tartalma:", rootGetters['cart/cart']);
      console.log("Rendelési adatok:", state.orderData);
      const cartItems = rootGetters['cart/cart'];
      if (!cartItems || cartItems.length === 0) {
        commit("SET_ORDER_ERROR", "A kosár üres, nem lehet rendelést leadni.");
        return false;
      }
      const totalSum = rootGetters['cart/totalSum'] || 0;
      const deliveryFee = state.orderData.deliveryMethod === 'home' ? 990 : 0;
      
      if (!state.orderData || !state.orderData.name || !state.orderData.email) {
        console.error("Hiányoznak a szállítási adatok", state.orderData);
        commit("SET_ORDER_ERROR", "Hiányos adatok a rendeléshez.");
        return false;
      }
      
      const characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      const charactersLength = characters.length;
      const orderId = characters.charAt(Math.floor(Math.random()*charactersLength)) +Math.floor(Math.random()*(1000000-100000)+100000);
   
      const orderData = {

        items: cartItems.map((item, index) => {
          
          return {
            book_id: item.id, 
            quantity: item.quantity,
            price: item.price,
            books_total_price: item.price * item.quantity
          };
        }),
        
        shipping: {
          name: state.orderData.name,
          email: state.orderData.email,
          phone: state.orderData.phone,
          address: state.orderData.address,
          method: state.orderData.deliveryMethod,
          fee: deliveryFee
        },
        
        payment_method: state.orderData.paymentMethod,
        total_amount: totalSum + deliveryFee,
        reference_id:orderId
      };
      
      console.log("Elküldhető adatok:", JSON.stringify(orderData));
      
  
      console.log("API kérés elküldése: /orders");
      const response = await http.post('/orders', orderData);
      

      console.log("API válasz:", response);
      
     
      commit("SET_ORDER_ID", orderId);
      commit("SET_TOTAL_PRICE", totalSum + deliveryFee);
      

      commit("cart/clearCart", null, { root: true });
      
      
      commit("SET_ORDER_STEP", 3);
      
      return true;
    } catch (error) {
      console.error("Hiba történt a rendelés során:", error);
      console.error("Hiba részletei:", error.response?.data.data || error.message);
      if (error.response) {
        if (error.response.status === 404) {
          commit("SET_ORDER_ERROR", "A rendelési API végpont nem található. (404)");
        } else if (error.response.status === 422) {
          commit("SET_ORDER_ERROR", "Hibás adatok a rendelésben. (422): " + 
            JSON.stringify(error.response.data?.errors || {}));
        } else if (error.response.status >= 500) {
          commit("SET_ORDER_ERROR", "Szerver hiba történt. Próbáld újra később. (500+)");
        } else {
          commit("SET_ORDER_ERROR", `API hiba: ${error.response.status}`);
        }
      } else if (error.request) {
      
        commit("SET_ORDER_ERROR", "Nem érkezett válasz a szervertől. Ellenőrizd az internetkapcsolatot.");
      } else {
       
        commit("SET_ORDER_ERROR", "Rendelés sikertelen: " + error.message);
      }
      return false;
    } finally {
      commit("SET_LOADING", false);
    }
  },
  
  
  resetOrder({ commit }) {
    commit("RESET_ORDER");
    commit("SET_ORDER_STEP", 1);
    return true;
  },

  async getData({ commit }) {
    try{
      const response = await http.get('/orders');
      commit('GET_ORDER_DATA', response.data.data);
      console.log('Rendelési adatok:', response.data.data);
      return true;
    }
    catch(error){
      console.error('Hiba a rendelési adatok lekérésekor:', error);
      return false;
    }
  },
};