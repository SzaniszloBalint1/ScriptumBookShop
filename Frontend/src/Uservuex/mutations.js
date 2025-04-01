export default {
    setBooks(state,books){
        state.books=books;
    },
    setBookId(state,book){
        state.bookId=book;
    },
    setSearch(state,search){
        state.search=search;
    },
    updateBook(state,book){
        const index=state.books.findIndex(b=>b.id===book.id);
        if (index !== -1) {
            state.books.splice(index, 1, book);
        }
    },
    deleteBook(state,id){
        state.books=state.books.filter(book=>book.id!==id);
    },
    newBook(state,book){
        state.books.push(book);
    },
    setMostViewedBooks(state, books) {
        state.mostviewedbooks = books;
    },
    incrementViewCounter(state,id){
        const book=state.mostviewedbooks.find(b=>b.id===id);
        if(book){
            book.views++;
        }
    },
    setLatestBooks(state,books){
        state.latestbooks=books;
    },
    setNewestBooks(state,books){
        state.newestbooks=books;
    },
    setMostCommentedBooks(state,books){
        state.mostcommentedbooks=books;
    },
    setMostLikedRating(state,books){
        state.mostlikedbooks=books;
    },
    setAuthorBooks(state, books) {
        state.authorBooks = books;
    },
   

}