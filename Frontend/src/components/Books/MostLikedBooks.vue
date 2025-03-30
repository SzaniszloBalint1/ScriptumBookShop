<template>
    <div class="col-md-8 mt-5 mb-5 mx-auto ">
        <h3>Legkedveltebb könyvek</h3>
        <hr>
        <div class="card-group" v-if="hasmostlikedbooks">
            <Card 
            v-for="book in mostlikedbooks" 
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
mostlikedbooks(){
return this.$store.getters['book/mostlikedbooks'];
},
hasmostlikedbooks(){
return this.$store.getters['book/hasmostlikedbooks'];
},
},
methods:{
getMostLikedRating(){
   this.$store.dispatch('book/getMostLikedRating');
}
},
created(){
this.getMostLikedRating();  
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