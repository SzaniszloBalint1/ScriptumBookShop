<template>
    <div class="col-md-8 mt-5 mb-5 mx-auto " v-if="hasBooks">
             <h3>A szerző további könyve</h3>
             <hr>
             <div class="card-group" >
                 <Card 
                 v-for="book in filteredBooks" 
                 :key="book.id"
                 :id="book.id" 
                 :name="book.title" 
                 :price="book.price" 
                 :img="book.cover_image" 
                 :author="book.author" 
             />
             </div>
         </div>
          <div class="col-md-8 mt-5 mb-5 mx-auto " v-if="!hasBooks">
            <MostViewedItem/>
              </div>


</template>



<script>
import Card from '@/layout/Card.vue';
import MostViewedItem from './MostViewedItem.vue';
export default {
 components:{
     Card,
     MostViewedItem
 },
 props: {
  author: {
    type: String,
    required: true
  },
  currentBookId: {
    type: [Number, String],
    required: true
  }
},  
     computed:{
        books() {
      return this.$store.getters['book/authorBooks'];
    },
    hasBooks() {
      const hasAuthorBooks = this.$store.getters['book/hasAuthorBooks'];
      if (!hasAuthorBooks) return false;
      return this.filteredBooks.length > 0;
    },
    filteredBooks() {
  return this.books.filter(book => book.id != this.currentBookId);
}
     },
     methods:{
         AuthorBooks(){
             this.$store.dispatch('book/getBooksByAuthor', this.author);
         }
     },
     created(){
        this.AuthorBooks();
     }
}

</script>



<style scoped>
.card-group {
display: flex;
flex-wrap: wrap;
gap:80px; 
justify-content: center; 

}



</style>