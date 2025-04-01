<template>
     <div id="app">
    <div class="register-container">
        <Form class="register-form" @submit="submitdata">
            <div v-if="statusMessage" 
             :class="['alert', statusSuccess ? 'alert-success' : 'alert-error']">
            {{ statusMessage }}
        </div>
            <h2>Regisztráció</h2>
            <div id="back">
                <button id="button" type="button" class="btn-close" @click="goToBack" aria-label="Close"></button>
            </div>

            <div class="input-container">
                <Field type="text" name="Username" placeholder="Felhasználónév..." v-model.trim="userdata.Username" required  :rules="usernamevalidate"/>
                <i class="fa-solid fa-user"></i>
                <ErrorMessage name="Username" class="error" />
            </div>
       

            <div class="input-container">
                <Field type="email" name="email" placeholder="Email..." v-model.trim="userdata.email" required :rules="emailvalidate" />
                <i class="fa-solid fa-envelope"></i>
                <ErrorMessage name="email" class="error" />
            </div>
          

            <div class="input-container">
                <Field type="Password" name="password" placeholder="Jelszó..." v-model.trim="userdata.password" required :rules="passwordvalidate" />
                <i class="fa-solid fa-lock"></i>
                <ErrorMessage name="password" class="error"/>
            </div>
           


            <div class="input-container">
                <Field type="Password" name="password_confirmation" placeholder="Jelszó újra..." v-model.trim="userdata.password_confirmation" required :rules="password_confirmationvalidate" />
                <i class="fa-solid fa-lock"></i>
                <ErrorMessage name="password_confirmation" class="error"/>
            </div>
         


            <div class="input-container">
                <Field type="text" name="FullName" placeholder="Teljes név..." v-model.trim="userdata.FullName" required :rules="fullNamevalidate"/>
                <i class="fa-solid fa-user"></i>
                <ErrorMessage name="FullName" class="error"/>
            </div>
        

            <div class="input-container">
                <Field type="text" name="PhoneNumber" placeholder="Telefonszám..." v-model.trim="userdata.PhoneNumber" required :rules="phonevalidate" />
                <i class="fa-solid fa-mobile"></i>
                <ErrorMessage name="PhoneNumber" class="error"/>
            </div>
            <button type="submit">Regisztráció</button>
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
                userdata:{
                    Username:"",
                    email:"",
                    password:"",
                    password_confirmation:"",
                      FullName:"",
                    PhoneNumber:"",
                },
                submitted:true,
                 statusMessage: '',
                    statusSuccess: false,
               
            };
        },
        methods:{
           async submitdata(values){
                const success=await this.$store.dispatch('user/registerUser',{
                    Username:this.userdata.Username,
                    email:this.userdata.email,
                    password:this.userdata.password,
                    password_confirmation:this.userdata.password_confirmation,
                    FullName:this.userdata.FullName,
                    PhoneNumber:this.userdata.PhoneNumber,
                });
                
                if(!success){
                    console.log("sikertelen regisztráció,valaki ezekkel az adatokkal már létezik",values);
                    this.statusSuccess = false;
                    this.statusMessage = 'Sikertelen regisztráció, valaki ezekkel az adatokkal már létezik.';
                    return;
                }
                else{
                    console.log("sikeres regisztráció",this.$store.state.user);
                    this.statusMessage="Sikeres regisztráció, ellenőrizd az email címed!";
                    this.statusSuccess = true;
                     this.$store.dispatch('user/sendMail', {
            email: this.userdata.email
        });
                    setTimeout(() => {
                        this.$router.push('/login');
                    }, 3000);
                   
                }
                
            },
         

            emailvalidate(value){
                if(!value){
                    return "Ne hagyd üresen a mezőt";
                }
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(value)) {
            return 'Nem megfelelő email cím formátum';
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

            password_confirmationvalidate(value){
                if(!value){
                    return "Ne hagyd üresen a mezőt";
                }
                if(value!=this.userdata.password){
                    return "A két jelszó nem egyezik meg";
                }
                if(value.length<=8){
                    return "A jelszónak legalább 8 karakter hosszúnak kell lennie";
                }
                return true;
            },
            phonevalidate(value){
                if(!value){
                    return "Ne hagyd üresen a mezőt";
                }   
                const phoneregex=/^(?:\+36|06)\s?(?:30|20|70)\s?\d{3}\s?\d{4}$/;
                if(!phoneregex.test(value)){
                    return "Érvénytelen telefonszám!";
                }
                return true;
            },

            usernamevalidate(value){
                if(!value){
                    return "Ne hagyd üresen a mezőt";
                }
                const userRegex = /^[A-Za-z0-9_-]{3,16}$/;
                if (!userRegex.test(value)) {
                    return 'min 3 és max 16 karakter lehet és nem lehet benne ékezet.';
            }
            return true;
        },
        fullNamevalidate(value){
            if(!value){
                return "Ne hagyd üresen a mezőt";
            }
            const nameRegex = /^[A-Za-zÁ-Úá-ú]+(\s[A-Za-zÁ-Úá-ú]+)+$/;
            if (!nameRegex.test(value)) {
                return 'Adj meg legalább két szót, betűkkel és ékezetekkel.';
            }
            return true;
        },

            goToBack(){
                return this.$router.push('/home');
            }
        },
        
}

</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
.error-message{
    color:red;
}
.error{
    color:red;
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
    color: black;
}
#back{
    position: absolute;
    top: -25px;
    right: 20px;
    background-color: transparent;
    border: none;
    color: black;
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
  justify-content: center;
  align-items: center;
  height: 100vh;
  width: 100vw;
  background-color: #f3f3f0;
  font-family: 'Roboto', sans-serif;
  background-repeat: no-repeat;
}

.register-form {
  background: rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(5px);
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
    color: black;
}

button:hover {
    background-color: #25b864;
    transition: all 0.3s ease;
}


</style>