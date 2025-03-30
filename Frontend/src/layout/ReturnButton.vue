<template>
    <button @click="Back"><slot></slot></button>

</template>

<script>
export default {
            methods:{
                Back(){
                    return this.$emit('step-back');
                }
            }
}
</script>

<style scoped>
button{
    background-color: transparent;
    border: none;
    cursor: pointer;
}

</style>