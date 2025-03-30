<template>
 <div class="app-container">
    <TheHeader></TheHeader>
    <main class="main-content">
      <KeepAlive>
        <router-view></router-view>
      </KeepAlive>
     
    </main>
    <div class="footer-spacer"></div>
    <Footer></Footer>
  </div>
</template>


<script>
import TheHeader from './layout/TheHeader.vue';

import Footer from './layout/Footer.vue';
export default {
    components:{
       TheHeader,
       Footer   
    },
    methods:{
       async  getUser(){
            const token =localStorage.getItem("token");
            if (token) {
                await this.$store.dispatch('user/user');
                console.log("sikeres belépés", this.$store.state.user); 
            }
        }
    },
    async created(){
        await this.getUser();
    }
}

</script>


<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
*{
    font-family: 'Roboto', sans-serif;
    font-size: 16px;
    margin: 0;
    padding: 0;
    
}
.app-container {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  position: relative;
  background-color: #f3f3f0 !important;
}

.main-content {
  width: 100%;
  margin-bottom: 80px;
}


.footer-spacer {
  height: 60px;
}



</style>
