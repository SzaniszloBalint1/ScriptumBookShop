export default {
 
    ratings(state) {
        return state.ratings;
    },
    hasratings(state) {
        return state.ratings && state.ratings.length > 0;
    },
    
   
    hasUserRated: (state) => (bookId) => {
        const user = state.userRatings[bookId];
        return user !== undefined;
    },
    
   
    getUserRating: (state) => (bookId) => {
        return state.userRatings[bookId];
    },
    
  
    getAverageRating: (state) => (bookId) => {
        const bookRatings = state.ratings.filter(r => r.book_id == bookId);
        if (bookRatings.length === 0) return 0;
        
        const sum = bookRatings.reduce((total, rating) => total + rating.rating, 0);
        return (sum / bookRatings.length).toFixed(1);
    }
}