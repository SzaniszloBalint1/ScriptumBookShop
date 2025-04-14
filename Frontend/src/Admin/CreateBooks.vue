<template>
    <div class="container mt-5 mb-5 rounded text-center w-50 mx-auto">
    <Form @submit="onSubmit">
        
            <h1 class="m-5">Új könyv létrehozása</h1>
            
            <div v-if="statusMessage" class="alert" :class="statusSuccess ? 'alert-success' : 'alert-danger'">
                {{ statusMessage }}
            </div>
       
        <div class="form-group">
            <label for="title">Cím:</label>
            <br>
            <Field name="title" type="text" placeholder="Cím" v-model.trim="title" :rules="titleValidate" aria-required="true" />
            <ErrorMessage name="title" class="error" />
        </div>
       
        <div class="form-group">
            <label for="author">Szerző:</label>
            <br>
            <Field name="author" type="text" placeholder="Szerző" v-model.trim="author" :rules="authorValidate" aria-required="true" />
            <ErrorMessage name="author" class="error" />
        </div>
        
        <div class="form-group">
            <label for="isbn">ISBN:</label>
            <br>
            <Field name="isbn" type="text" placeholder="ISBN" v-model="isbn" :rules="isbnValidate" aria-required="true" />
            <button type="button" class="btn btn-outline-secondary" @click="generateIsbn">Generálás</button>
            <ErrorMessage name="isbn" class="error" />
        </div>
    
        <div class="form-group">
            <label for="publish_date">Kiadás dátuma:</label>
            <br>
            <Field name="publish_date" type="text" placeholder="Kiadás dátuma (YYYY-MM-DD)" v-model="publish_date" :rules="dateValidate" aria-required="true"/>
            <ErrorMessage name="publish_date" class="error" />
        </div>
    
        <div class="form-group">
            <label for="price">Ár:</label>
            <br>
            <Field name="price" type="text" placeholder="Ár" v-model="price" :rules="priceValidate" aria-required="true" />
            <ErrorMessage name="price" class="error" />
        </div>
        <div class="form-group">
            <label for="describe">Leírás:</label>
            <br>
            <Field name="describe" type="text" placeholder="Leírás" v-model.trim="describe" :rules="describeValidate" aria-required="true" />
            <ErrorMessage name="describe" class="error" />
        </div>
        <div class="form-group">
            <label for="cover_image">Borítókép URL:</label>
            <br>
            <Field name="cover_image" type="text" placeholder="Borítókép URL" v-model.trim="cover_image" :rules="coverValidate" aria-required="true"/>
            <ErrorMessage name="cover_image" class="error" />
        </div>

        <div class="form-group">
            <label for="category">Kategória:</label>
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ selectedCategory ? selectedCategory.CategoryName : 'Válassz kategóriát' }}
                </button>
                <ul class="dropdown-menu">
                    <li v-for="category in categories" :key="category.id" @click="selectCategory(category)" class="category-item">
                        {{ category.CategoryName }}
                    </li>
                </ul>
            </div>
            <div v-if="!selectedCategory && formSubmitted" class="error">Válassz egy kategóriát</div>
        </div>

        <button type="submit" class="btn btn-success submit-btn" :disabled="isSubmitting">
            {{ isSubmitting ? 'Létrehozás folyamatban...' : 'Könyv létrehozása' }}
        </button>
    </Form>
    </div>  
</template>
    
<script>
import { Form, Field, ErrorMessage } from 'vee-validate';

export default {
    components: {
        Form,
        Field,
        ErrorMessage
    },
    data(){
        return{
            title: "",
            author: "",
            isbn: "",
            publish_date: "",
            price: "",
            cover_image:"",
            describe:'',
            selectedCategory: null,
            statusMessage: '',
            statusSuccess: false,
            formSubmitted: false,
            isSubmitting: false
        };
    },
    computed:{
       categories(){
        return this.$store.getters['category/categories'];
       },
       hascategories(){
        return this.$store.getters['category/hascategories'];
       },
    },
    methods:{ 
        generateIsbn() {
        let result = '';
        for (let i = 0; i < 12; i++) {
            result += Math.floor(Math.random() * 10);
        }
        let sum = 0;
        for (let i = 0; i < 12; i++) {
            sum += parseInt(result[i]) * (i % 2 === 0 ? 1 : 3);
        }
        const checkDigit = (10 - (sum % 10)) % 10;
        this.isbn = result + checkDigit;
    },
        titleValidate(value) {
            if (!value) {
                return "A könyv címe nem lehet üres";
            }
            if (value.length < 2) {
                return "A könyv címe legalább 2 karakter hosszú legyen";
            }
            return true;
        },
        authorValidate(value) {
            if (!value) {
                return "A szerző neve nem lehet üres";
            }
            if (value.length < 2) {
                return "A szerző neve legalább 2 karakter hosszú legyen";
            }
            return true;
        },
        isbnValidate(value) {
            if (!value) {
                return "Az ISBN mező nem lehet üres";
            }
            const isbnRegex = /^(?:\d{13})$/;
            if (!isbnRegex.test(value.replace(/[-\s]/g, ''))) {
                return "Érvénytelen ISBN formátum (13 számjegy)";
            }
            return true;
        },
        dateValidate(value) {
            if (!value) {
                return "A kiadás dátuma nem lehet üres";
            }
            const dateRegex = /^\d{4}(-\d{2}){0,2}$/;
            if (!dateRegex.test(value)) {
                return "Érvénytelen dátum formátum (YYYY-MM-DD)";
            }
            return true;
        },
        priceValidate(value) {
            if (!value) {
                return "Az ár nem lehet üres";
            }
            if (isNaN(Number(value)) || Number(value) <= 0) {
                return "Az árnak pozitív számnak kell lennie";
            }
            return true;
        },
        describeValidate(value) {
            if (!value) {
                return "A leírás nem lehet üres";
            }
            if (value.length < 10) {
                return "A leírás legalább 10 karakter hosszú legyen";
            }
            return true;
        },
        coverValidate(value) {
            if (!value) {
                return "A borítókép URL nem lehet üres";
            }
            const urlRegex = /^(https?:\/\/)([\da-z.-]+)\.([a-z.]{2,6})([/\w.-]*)*\/?$/;
            if (!urlRegex.test(value)) {
                return "Érvényes URL-t adj meg";
            }
            return true;
        },
        selectCategory(category) {
            this.selectedCategory = category;
        },
        getCategory(){
            this.$store.dispatch('category/getCategories');
        },
        async onSubmit(){
    this.formSubmitted = true;
    
    if (!this.selectedCategory) {
        alert("Válassz kategóriát!");
        return;
    }
    
    this.isSubmitting = true;
    
    try {
        const cleanedIsbn = this.isbn.replace(/[-\s]/g, '');
        
        const FormData = {
            title: this.title.trim(),
            author: this.author.trim(),
            isbn: String(cleanedIsbn),
            publish_date: this.publish_date.trim(),
            price: Number(this.price),
            cover_image: this.cover_image.trim(),
            describe: this.describe.trim(),
            category_id: this.selectedCategory.id 
        };
        
        console.log("Küldendő adatok:", FormData);
        
        const success = await this.$store.dispatch('book/newBook', FormData);
        
        if (success) {
            console.log("Könyv sikeresen létrehozva", FormData);
            this.statusSuccess = true;
            this.statusMessage = 'Könyv sikeresen létrehozva!';
            
            await this.$store.dispatch('book/getData');
            
            setTimeout(() => {
                this.$router.push('/admin');
            }, 2000);
        }
    } catch (error) {
        console.error("Sikertelen létrehozás", error);
        this.statusSuccess = false;
        this.statusMessage = 'Könyv létrehozása sikertelen: ' + (error.response?.data?.message || error.message || 'Ismeretlen hiba történt.');
    } finally {
        this.isSubmitting = false;
    }
}
    },
    created() {
        this.getCategory();
    }
}
</script>


<style scoped> 
.dropdown {
    position: relative;
    display: block;
    width: 100%;
}

.dropdown-menu {
    display: none;
    position: absolute;
    background-color: white;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 2000;
    padding: 10px;
    text-align: left;
}

.dropdown-menu.show {
    display: block;
}

.category-item {
    cursor: pointer;
    padding: 8px;
}

.category-item:hover {
    background-color: #f5f5f5;
}

.form-group {
    display: flex;
    flex-direction: column;
    margin: 10px 0;
    position: relative;
}

label {
    align-items: left !important;
    justify-content: left !important;
    text-align: left !important;
    margin-bottom: 5px;
    font-weight: 500;
}

input {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.btn {
    padding: 10px;
    margin: 5px 0;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.submit-btn {
    margin-top: 20px;
    background-color: #2E8B57;
    color: white;
    font-weight: bold;
    width: 100%;
    font-size: 18px;
    transition: background-color 0.3s;
}

.submit-btn:hover {
    background-color: #25704a;
}

.error {
    color: #dc3545;
    font-size: 14px;
    margin-top: 5px;
    text-align: left;
}

@media (max-width: 992px) {
    .container {
        width: 70% !important;
    }
}

@media (max-width: 768px) {
    .container {
        width: 90% !important;
    }
}

@media (max-width: 576px) {
    .container {
        width: 100% !important;
        padding: 15px !important;
    }
    
    h1 {
        font-size: 24px;
    }
    
    .dropdown {
        right: 0;
    }
}
</style>
