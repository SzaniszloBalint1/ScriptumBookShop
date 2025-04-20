import actions from "./actions";
import mutations from "./mutations";
import getters from "./getters";

export default {
  namespaced: true,
  
  state: () => ({
    orderData: {
      name: "",
      email: "",
      address: "",
      phone: "",
      deliveryMethod: "pickup",
      paymentMethod: "Utánvét", 
    },
    orderId: "",
    deliveryFee: 0,
    totalPrice: 0,
    isLoading: false,
    orderError: null,
    orderStep: 1, 
    orderdata:[]
  }),
  
  getters,
  actions,
  mutations
};
