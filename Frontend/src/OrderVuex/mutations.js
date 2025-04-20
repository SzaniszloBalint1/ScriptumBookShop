export default {
    SET_ORDER_DATA(state, userData) {
      state.orderData = { ...state.orderData, ...userData };
      state.deliveryFee = userData.deliveryMethod === "home" ? 990 : 0;
    },
    SET_ORDER_ID(state, orderId) {
      state.orderId = orderId;
    },
    SET_TOTAL_PRICE(state, total) {
      state.totalPrice = total;
    },
    SET_LOADING(state, isLoading) {
      state.isLoading = isLoading;
    },
    SET_ORDER_ERROR(state, error) {
      state.orderError = error;
    },
    SET_ORDER_STEP(state, step) {
      state.orderStep = step;
    },
    RESET_ORDER(state) {
      state.orderData = {
        name: "",
        email: "",
        address: "",
        phone: "",
        deliveryMethod: "pickup",
        paymentMethod: "Utánvét",
      };
      state.orderId = "";
      state.deliveryFee = 0;
      state.totalPrice = 0;
      state.orderError = null;
    },
    GET_ORDER_DATA(state, orderdata){
      state.orderdata = orderdata;
    }
  };