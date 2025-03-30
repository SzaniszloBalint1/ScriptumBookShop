<template>
    
         
    
    <div class="col-md-8 mt-5 mb-5 mx-auto ">
        <h3>Legújabb könyvek</h3>
        <hr>
        <div class="card-group" v-if="hasnewestbooks">
            <Card 
            v-for="book in newestbooks" 
            :key="book.id"
            :id="book.id" 
            :name="book.title" 
            :price="book.price" 
            :img="book.cover_image" 
            :author="book.author" 
        />
        </div>
       
    </div>
   
  
   
</template>

<script>
import Card from '@/layout/Card.vue';

export default {
components:{
Card,
},
computed:{
    newestbooks(){
      return this.$store.getters['book/newestbooks'];
    },
    hasnewestbooks(){
      return this.$store.getters['book/hasnewestbooks'];
    }
},
methods:{
    getNewestBooks(){
    this.$store.dispatch('book/getNewestBooks');
}
},
created(){
this.getNewestBooks();  
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