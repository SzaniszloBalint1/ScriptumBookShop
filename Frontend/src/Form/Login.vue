<template>
    <div id="app">
    <div class="register-container">
        <Form class="register-form"  @submit="submitdata">
            <div v-if="statusMessage" :class="['alert', statusSuccess? 'alert-success': 'alert-danger']">{{ statusMessage }}</div>
            <h2>Belépés</h2>
            <div id="back">
                <button id="button" type="button" class="btn-close" @click="goToBack" aria-label="Close"></button>
            </div>
            <div class="input-container">
                <Field type="email" name="email" placeholder="Email..." v-model.trim="email" required  :rules="emailvalidate"/>
                <i class="fa-solid fa-envelope"></i>
                <ErrorMessage name="email" class="error" />
            </div>
            <div class="input-container">
                <Field type="Password" name="password" placeholder="Jelszó..." v-model.trim="password" required :rules="passwordvalidate"/>
                <i class="fa-solid fa-lock"></i>
                <ErrorMessage name="password" class="error"/>
            </div>   
            <router-link to="/password-reset" class="router">Elfelejtett jelszó</router-link>
            <button type="submit">Bejelentkezés</button>
            <hr>
        <p><strong>Még nem regisztrált?</strong></p>
        <router-link to="/register" class="link">Regisztráció</router-link>
        </Form>
       
    </div>
</div>
</template> 


<script>
import { Form,Field,ErrorMessage } from 'vee-validate';
export default {
    components:{
        Form,
        Field,
        ErrorMessage
    },
    data(){
            return{
                email:"",
                password:"",
                submitted:true,
                errorMessage:"",
                trylogin:1,
                statusMessage: '',
                statusSuccess: false,
            };
        },
    
        methods:{
         
        async submitdata(values) {
             try {
                    const result = await this.$store.dispatch('user/loginUser', {
             email: this.email,
            password: this.password,
            });
            if (result) {
        console.log('sikeres adatfelvétel', values);
        this.statusSuccess = true;
        this.statusMessage = 'Sikeres bejelentkezés!';
        setTimeout(() => {
            this.$router.push('/home');
        }, 2000);
            } else if (!result && this.trylogin === 3) {
                this.statusSuccess = false;
                this.statusMessage="Háromszor hibás jelszó vagy email cím! Regisztrálj!";
                
                setTimeout(() => {
                    this.$router.push('/register');
                }
                , 2000);
               
             }
            else {
                this.trylogin++;
                this.statusMessage = 'Hibás email cím vagy jelszó!';
                this.statusSuccess = false;
                
            }
        } catch (error) {
            console.error('Hiba történt belépéskor:', error);
        }
},
            

            emailvalidate(value){
                if(!value){
                    return "Ne hagyd üresen a mezőt";
                }
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
        return 'nem megfelelő email cím formátum';
      }
      return true;
            },

            passwordvalidate(value){
                if(!value){
                    return "Ne hagyd üresen a mezőt";
                }
                if(value.length<=8){
                    return "A jelszónak legalább 8 karakter hosszúnak kell lennie";
                }
                return true;
            },

          
            goToBack(){
                return this.$router.push('/home');
            },
        
            
        },
        created() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('verified') === 'true') {
        this.statusSuccess = true;
       this.statusMessage="Sikeres regisztráció, ellenőrizd az email címed!";
      
    }
    if (urlParams.get('reset') === 'success') {
        this.statusSuccess = true;
       this.statusMessage="Sikeres jelszóváltoztatás!";
       
    }
},
}

</script>


<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
p{
    text-align: left;
    color:#333333;
}
.link{
    color: #333333;
    text-align: left;
    display: block;
}


.error-message{
    color:red;
}
.error{
  color: red;
}

.input-container {
  position: relative;
  margin: 10px 0;
}

.input-container i {
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
}

#button{
    background-color: transparent;
    border: none;
    color: #333333;
}
#back{
    position: absolute;
    top: -25px;
    right: 20px;
    background-color: transparent;
    border: none;
    color: #333333;
}

html, body {
  margin: 0;
  padding: 0;
  height: 100%;
  width: 100%;
  box-sizing: border-box;
}

body {
  display: flex;
  justify-content: center;
  align-items: center;
}

.register-container {
  display: flex;
  justify-content: center ;
  align-items: center;
  height: 100vh;
  width: 100vw;
  background-color: #f3f3f0;
  font-family: 'Roboto', sans-serif;
  background-repeat: no-repeat;
 
}
.router{
    color: #333333;
    font-size: 1rem;
    justify-content: left !important;
    align-items: left !important;
    text-align: left !important;
    display: block;
    margin-top: 20px;

}
.register-form {
   
  background: rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(10px);
  background: transparent;
    padding: 20px;
  border-radius: 15px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    text-align: center;
    width: 50%; 
    max-width: 500px; 
}


button {
    margin-top:20px ;
    background-color: #2E8B57;
  border: 1px solid #2E8B57;
  border-radius: 5px;
  width: 100%;
  height: 40px;
  font-size: 1.2rem;
}

input{
    border-top-color: transparent;
    border-right-color: transparent;
    border-left-color: transparent;
    border-bottom-color:#2E8B57 ;
    border-radius: 5px;
    padding: 10px;
    width: 100%;
    margin: 5px;
    background: transparent;
}
input::placeholder{
    color: #333333;
}

button:hover {
    background-color: #25b864;
    transition: all 0.5s ease;
}


</style>
