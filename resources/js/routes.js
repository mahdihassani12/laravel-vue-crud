import VueRouter from "vue-router";
import AllProduct from "./components/AllProduct";
import CreateProduct from "./components/CreateProduct";
import EditProduct from "./components/EditProduct";

const routes = [
    {
        path: "/products",
        component: AllProduct,
        name: "Products"
    },
    {
        path: "/create",
        component: CreateProduct,
        name: "Create"
    },
    {
        path: "/edit:id",
        component: EditProduct,
        name: "Edit"
    },
];

const router = new VueRouter({
    routes, 
    mode: "history"
});

export default router;