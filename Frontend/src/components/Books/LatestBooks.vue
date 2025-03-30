<template>
    <div class="col-md-8 mt-5 mb-5 mx-auto ">
        <h3>Legrégebben írt könyvek</h3>
        <hr>
        <div class="card-group" v-if="haslatestbooks">
            <Card 
            v-for="book in latestbooks" :key="book.id" :id="book.id" :name="book.title" :price="book.price" :img="book.cover_image" :author="book.author" />
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
    latestbooks(){
      return this.$store.getters['book/latestbooks'];
    },
    haslatestbooks(){
      return this.$store.getters['book/haslatestbooks'];
    }
},
methods:{
    getLatestBooks(){
    this.$store.dispatch('book/getLatestBooks');
}
},
created(){
this.getLatestBooks();  
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