import { createStore } from "vuex";
import Booksvuex from "./Booksvuex";
import CartVuex from "./CartVuex";
import Uservuex from "./Uservuex";
import CategoryVuex from "./CategoryVuex";
import CommentVuex from "./CommentVuex";
import RatingVuex from "./RatingVuex";
import SearchVuex from "./SearchVuex";
import OrderVuex from "./OrderVuex";
const store=createStore({
    modules:{
        book:Booksvuex,
        cart:CartVuex,
        user:Uservuex,
        category:CategoryVuex,
        comment:CommentVuex,
        rating:RatingVuex,
        search:SearchVuex,
        order:OrderVuex
    }

});

export default store;