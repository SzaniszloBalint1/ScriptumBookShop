<template>
   <div class="col-md-8 mt-5 mb-5 mx-auto ">
                <h3>További könyvek</h3>
                <hr>
    <div class="card-group" v-if="hasbooks">
        <Card v-for="book in books" :key="book.id" :id="book.id" :name="book.title" :price="book.price" :img="book.cover_image" :author="book.author" >
        </Card>
    </div>
<p v-else>Nincs könyv adat amit megjelenítsünk</p>
   </div>
</template>


<script>
import Card from '@/layout/Card.vue';

export default {
    components:{
        Card
    },
    computed:{
        books(){
            return this.$store.getters['book/books'].splice(0,5);       
        },
        hasbooks(){
            return this.$store.getters['book/hasBooks'];
        }
    },
    methods:{
        getBooks(){
            this.$store.dispatch('book/getData');
        }
    },
    created(){
        this.getBooks();
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
