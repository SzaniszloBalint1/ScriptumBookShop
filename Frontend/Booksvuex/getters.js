

export default{
        books(state){
            return state.books;
        },
        hasBooks(state){
            return state.books && state.books.length>0;
        },
        bookId(state){
            return state.bookId;
        },
        booksForCategory: (state) => (categoryId) => {
            if (!categoryId || !state.books) return [];
            
            const numericCategoryId = Number(categoryId);
            
            return state.books.filter(book => {
                if (book.categories && Array.isArray(book.categories)) {
                    return book.categories.some(cat => Number(cat.id) === numericCategoryId);
                }
                
                if (book.category_id !== undefined) {
                    return Number(book.category_id) === numericCategoryId;
                }
                
                return false;
            });
        },
        filteredBooks: (state) => (search) => {
            if(search.length<3){
                return [];
            }
            return state.books.filter(book=>book.title.toLowerCase().includes(search.toLowerCase())).slice(0,5);
        },
        search(state){
            return state.search;
        },
        mostviewedbooks(state){
            return state.mostviewedbooks;
        },
        hasmostviewedbooks(state){
            return state.mostviewedbooks && state.mostviewedbooks.length>0;
        },
        latestbooks(state){
            return state.latestbooks;
        },
        haslatestbooks(state){
            return state.latestbooks && state.latestbooks.length>0;
        },
        newestbooks(state){
            return state.newestbooks;
        },
        hasnewestbooks(state){
            return state.newestbooks && state.newestbooks.length>0;
        },
        mostcommentedbooks(state){
            return state.mostcommentedbooks;
        },
        hasmostcommentedbooks(state){
            return state.mostcommentedbooks && state.mostcommentedbooks.length>0;
        },
        mostlikedbooks(state){
            return state.mostlikedbooks;
        },
        hasmostlikedbooks(state){
            return state.mostlikedbooks && state.mostlikedbooks.length>0;
        },
        authorBooks(state) {
            return state.authorBooks || [];
        },
        hasAuthorBooks(state) {
            return state.authorBooks && state.authorBooks.length > 0;
        },
        
}