<template>
    
         
    
            <div class="col-md-8 mt-5 mb-5 mx-auto ">
                <h3>Legnézettebb könyvek</h3>
                <hr>
                <div class="card-group" v-if="hasmostviewedBooks">
                    <Card 
                    v-for="book in mostviewedBooks" 
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
        mostviewedBooks(){
            return this.$store.getters['book/mostviewedbooks'];
        },
        hasmostviewedBooks(){
            return this.$store.getters['book/hasmostviewedbooks'];
        }
    },
    methods:{
        getMostViewedBooks(){
           this.$store.dispatch('book/fetchMostViewedBooks');
        }
    },
    created(){
        this.getMostViewedBooks();  
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