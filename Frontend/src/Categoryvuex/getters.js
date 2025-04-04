export default {
    categories(state){
        return state.categories;
    },
    hascategories(state){
        return state.categories && state.categories.length>0;
    },
    categoryId(state){
        return state.categoryId;
    }
}