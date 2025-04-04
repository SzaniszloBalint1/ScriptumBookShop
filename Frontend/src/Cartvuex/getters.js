export default {
            cart(state){
                return state.cart;
            },
            hascart(state){
                return state.cart && state.cart.length>0;
            },
            totalCart(state){
                return state.cart.map(item => ({
                    name: item.name, 
                    totalPrice: item.price * item.quantity
                }));
            },
            totalSum(state){
                return state.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            }
}