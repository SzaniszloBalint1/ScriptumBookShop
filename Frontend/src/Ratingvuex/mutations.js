export default {

    setRatings(state, ratings) {
        state.ratings = ratings;
    },
    
    addRating(state, rating) {
        state.ratings.push(rating);
        state.userRatings = {
            ...state.userRatings,
            [rating.book_id]: rating.rating
        };
    },
    

    setUserRatings(state, ratings) {
        const userRatings = {};
        ratings.forEach(rating => {
            userRatings[rating.book_id] = rating.rating;
        });
        
        state.userRatings = userRatings;
    },
    

    deleteRating(state, ratingId) {
        const rating = state.ratings.find(r => r.id === ratingId);
        
        if (rating) {
            delete state.userRatings[rating.book_id];
        }
        
        state.ratings = state.ratings.filter(r => r.id !== ratingId);
    },
    

    updateRating(state, updatedRating) {
        const index = state.ratings.findIndex(r => r.id === updatedRating.id);
        
        if (index !== -1) {
            state.ratings[index] = updatedRating;
            state.userRatings[updatedRating.book_id] = updatedRating.rating;
        }
    }
}