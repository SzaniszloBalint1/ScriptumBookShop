export default {
   
    addItemToCart(state, book) {
        const existingItem = state.cart.find(item => item.id === book.id);
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            const newItem = { ...book, quantity: 1 };
            state.cart.push(newItem);
        }
        localStorage.setItem('cart', JSON.stringify(state.cart));
    },
    removeAnItemFromCart(state, book) {
        const existingItem = state.cart.find(item => item.id === book.id);
        if (existingItem) {
            existingItem.quantity -= 1;
        }
        if (existingItem.quantity === 0) {
            state.cart = state.cart.filter(item => item.id !== book.id);
        }
        localStorage.setItem('cart', JSON.stringify(state.cart));
    },
    removeItemFromCart(state, book) {
        state.cart = state.cart.filter(item => item.id !== book.id);
        localStorage.setItem('cart', JSON.stringify(state.cart));
    },
    clearCart(state) {
        state.cart = [];
        localStorage.setItem('cart', JSON.stringify(state.cart));
    }
}