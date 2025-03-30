import { createRouter, createWebHistory } from "vue-router";
import store from "./vuex";


const Main = () => import(/* webpackPrefetch: true */ "./components/Books/Main.vue");
const Login = () => import(/* webpackPrefetch: true */ "./Form/Login.vue");
const Register = () => import("./Form/Register.vue");
const ItemDetails = () => import(/* webpackPreload: true */ "./components/Books/ItemDetails.vue");
const NotFound = () => import("./layout/NotFound.vue");
const Cart = () => import("./components/Cart/Cart.vue");
const CategoryDetails = () => import("./components/Category/CategoryDetails.vue");
const Admin = () => import(/* webpackPreload: true */ "./Admin/AdminBooks.vue");
const UpdateBooks = () => import("./Admin/UpdateBooks.vue");
const CreateBooks = () => import("./Admin/CreateBooks.vue");
const UserSettings = () => import("./Admin/UserSettings.vue");
const RoleSettings = () => import("./Admin/RoleSettings.vue");
const Email = () => import("./components/PasswordReset/Email.vue");
const ResetPassword = () => import("./components/PasswordReset/ResetPassword.vue");
const UserDataSettings = () => import("./components/UserDataSettings.vue");
const UserDatas = () => import("./components/Purchase/UserDatas.vue");
const UserOrderDatas=()=>import("./components/UserOrderDatas.vue");

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', redirect: '/home' },
        { path: '/home', component: Main, meta: { title: "Kezdőlap" } },
        { path: '/login', component: Login, meta: { title: "Bejelentkezés" } },
        { path: '/books/:id', component: ItemDetails, name: 'itemDetails', meta: { title: "Könyv Adatok" } },
        { path: '/register', component: Register, meta: { title: "Regisztráció" } },
        { path: '/:NotFound(.*)', component: NotFound, meta: { title: "404" } },
        { path: '/cart', component: Cart, meta: { title: "Kosár" } },
        { path: '/categories/:id', component: CategoryDetails,props:true, name: 'categoryDetails', meta: { title: "Kategória Adatok" } },
        { path: '/admin', component: Admin, meta: { title: "Admin", requiresAdmin: true } },
        { path: '/update/:id', component: UpdateBooks, name: 'updateBooks', meta: { title: "Könyv Módosítás", requiresAdmin: true } },
        { path: '/create', component: CreateBooks, name: 'createBooks', meta: { title: "Könyv Létrehozás", requiresAdmin: true } },
        { path: "/settings", component: UserSettings, meta: { title: "Felhasználói Beállítások", requiresAdmin: true } },
        { path: '/role/:id', component: RoleSettings, name: 'roleSettings', meta: { title: "Role Beállítások", requiresAdmin: true } },
        { path: '/password-reset', component: Email, meta: { title: "Jelszó Visszaállítás" } },
        { path: '/password-reset/:token', component: ResetPassword, meta: { title: "Jelszó Visszaállítás" } },
        { path: "/usersettings", component: UserDataSettings, meta: { title: "Felhasználói Beállítások" } },
        { path: '/purchase', component: UserDatas, meta: { title: "Vásárlás", requiresLogin: true } },
        {path:'/usersorder',component:UserOrderDatas,meta:{title:"Rendelések",requiresLogin:true}}
    ]
});

router.beforeEach(async (to, from, next) => {
    document.title = `Scriptum - ${to.meta.title}`;
    
    const token = localStorage.getItem("token");
    if (token) {
        try {
            await store.dispatch('user/user');
        } catch (error) {
            console.error("Hiba a felhasználói adatok betöltésekor:", error);
        }
    }
    if (to.matched.some(record => record.meta.requiresAdmin)) {
        const userole = store.getters['user/role'];
        if (userole === 'admin') {
            next();
        } else {
            next('/home');
        }
    } else if (to.matched.some(record => record.meta.requiresLogin)) {
        const user = store.getters['user/user'];
        if (!user) {
            next('/login');
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;