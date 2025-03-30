<template>
       <div class="col-md-8 mt-5 mb-5 mx-auto ">
                <h3>Legtöbbett kommentelt könyvek</h3>
                <hr>
                <div class="card-group" v-if="hasmostcommentedbooks">
                    <Card 
                    v-for="book in mostcommentedbooks" 
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
            mostcommentedbooks(){
                return this.$store.getters['book/mostcommentedbooks'];
            },
            hasmostcommentedbooks(){
                return this.$store.getters['book/hasmostcommentedbooks'];
            }
        },
        methods:{
            getMostCommentedBooks(){
                this.$store.dispatch('book/getMostCommentedBooks');
            }
        },
        created(){
            this.getMostCommentedBooks();
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