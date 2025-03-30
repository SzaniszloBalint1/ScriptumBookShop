<template>
<MostViewedItem></MostViewedItem>
<MostLikedBooks></MostLikedBooks>
<MostCommentedBooks></MostCommentedBooks>
<NewestBooks></NewestBooks>
<LatestBooks></LatestBooks>
<Item></Item>

</template>

<script>
import Item from './Item.vue';
import MostViewedItem from './MostViewedItem.vue';
import LatestBooks from './LatestBooks.vue';
import NewestBooks from './NewestBooks.vue';
import MostCommentedBooks from './MostCommentedBooks.vue';
import MostLikedBooks from './MostLikedBooks.vue';
export default {
    components:{
        Item,
        MostViewedItem,
        LatestBooks,
        NewestBooks,
        MostCommentedBooks,
        MostLikedBooks
    },
    
}
</script>

