import { createRouter, createWebHistory, type RouteRecordRaw } from "vue-router"
import Dashboard from "../pages/Dashboard.vue"

const routes: RouteRecordRaw[] = [
    {
        path: "/",
        component: Dashboard,
        name: "dashboard"
    },
    {
        path: "/category",
        children: [
            {
                path: "list",
                component: () => import("../pages/category/CategoryList.vue"),
                name: "category-list"
            },
            {
                path: "new",
                component: () => import("../pages/category/CreateCategory.vue"),
                name: "create-category"
            }
        ]
    },
    {
        path: "/product",
        children: [
            {
                path: "list",
                component: () => import("../pages/product/ProductList.vue"),
                name: "product-list"
            },
            {
                path: "new",
                component: () => import("../pages/product/CreateProduct.vue"),
                name: "create-product"
            }
        ]
    },
    {
        path: "/supplier",
        children: [
            {
                path: "list",
                component: () => import("../pages/supplier/SupplierList.vue"),
                name: "supplier-list"
            },
            {
                path: "new",
                component: () => import("../pages/supplier/CreateSupplier.vue"),
                name: "create-supplier"
            }
        ]
    },
    {
        path: "/purchase-order",
        children: [
            {
                path: "list",
                component: () => import("../pages/purchase/PurchaseOrderList.vue"),
                name: "purchase-order-list"
            },
            {
                path: "new",
                component: () => import("../pages/purchase/CreatePurchaseOrderList.vue"),
                name: "create-purchase-order"
            },
            {
                path: ":id/detail",
                component: () => import("../pages/purchase/ViewPurchaseOrderDetail.vue"),
                name: "purchase-order-detail"
            }
        ]
    },
    {
        path: "/supplier-ledger",
        children: [
            {
                path: "list",
                component: () => import("../pages/ledger/SupplierLedgerList.vue"),
                name: "supplier-ledger-list"
            },
            {
                path: "new",
                component: () => import("../pages/ledger/CreateSupplierLedgerList.vue"),
                name: "create-supplier-ledger"
            }
        ]
    }    
]

export const router = createRouter({
    history: createWebHistory(),
    routes
})