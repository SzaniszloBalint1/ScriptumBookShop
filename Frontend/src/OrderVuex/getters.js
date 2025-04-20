export default {
    orderData(state){
        return state.orderData || {};
    },
    orderId(state){
        return state.orderId || '';
    },
    deliveryFee(state){
        return state.deliveryFee || 0;
    },
    totalPrice(state){
        return state.totalPrice || 0;
    },
    isLoading(state){
        return state.isLoading || false;
    },
    orderError(state){
        return state.orderError || null;
    },
    orderStep(state){
        return state.orderStep || 1;
    },
    deliveryMethodText(state){
        if (state.orderData && state.orderData.deliveryMethod) {
            return state.orderData.deliveryMethod === 'home' 
                ? 'Házhozszállítás (+990 Ft)' 
                : 'Személyes átvétel (ingyenes)';
        }
        return '';
    },
    orderdata(state){
        return state.orderdata || [];
    }
};