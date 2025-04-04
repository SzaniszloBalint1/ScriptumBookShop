<template>
<button @click="CartPage"><slot></slot></button>
</template>


<script>
export default{
    methods:{
        CartPage(){
            return this.$router.push('/cart');
        }
    }
}
</script>


