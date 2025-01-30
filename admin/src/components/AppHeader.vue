<script setup lang="ts">
   import { RouterLink } from 'vue-router'
</script>

<template>
    <header class="bg-white shadow-sm p-4 flex justify-between items-center">
      <RouterLink :to="{name: 'dashboard'}" class="font-roboto text-xl uppercase text-gray-600">Laravel Vue POS</RouterLink>
      <ul class="flex space-x-4">
        <li><RouterLink :to="{name: 'dashboard'}" exact-active-class="text-indigo-600" class="px-2 font-roboto hover:text-indigo-600">Dashboard</RouterLink></li>
        <li><RouterLink :to="{name: 'category-list'}" exact-active-class="text-indigo-600" class="px-2 font-roboto hover:text-indigo-600">Categories</RouterLink></li>
        <li><RouterLink :to="{name: 'create-category'}" exact-active-class="text-indigo-600" class="px-2 font-roboto hover:text-indigo-600">Create Category</RouterLink></li>
        <li><RouterLink :to="{name: 'product-list'}" exact-active-class="text-indigo-600" class="px-2 font-roboto hover:text-indigo-600">Products</RouterLink></li>
        <li><RouterLink :to="{name: 'create-product'}" exact-active-class="text-indigo-600" class="px-2 font-roboto hover:text-indigo-600">Create Product</RouterLink></li>
        <li><RouterLink :to="{name: 'supplier-list'}" exact-active-class="text-indigo-600" class="px-2 font-roboto hover:text-indigo-600">Suppliers</RouterLink></li>
        <li><RouterLink :to="{name: 'create-supplier'}" exact-active-class="text-indigo-600" class="px-2 font-roboto hover:text-indigo-600">Create Supplier</RouterLink></li>
        <li><RouterLink :to="{name: 'purchase-order-list'}" exact-active-class="text-indigo-600" class="px-2 font-roboto hover:text-indigo-600">Purchase Orders</RouterLink></li>
        <li><RouterLink :to="{name: 'create-purchase-order'}" exact-active-class="text-indigo-600" class="px-2 font-roboto hover:text-indigo-600">Create Purchase Order</RouterLink></li>
        <li><RouterLink :to="{name: 'supplier-ledger-list'}" exact-active-class="text-indigo-600" class="px-2 font-roboto hover:text-indigo-600">Supplier Ledgers</RouterLink></li>
        <li><RouterLink :to="{name: 'create-supplier-ledger'}" exact-active-class="text-indigo-600" class="px-2 font-roboto hover:text-indigo-600">Add Supplier Ledger</RouterLink></li>
      </ul>
    </header>
</template>