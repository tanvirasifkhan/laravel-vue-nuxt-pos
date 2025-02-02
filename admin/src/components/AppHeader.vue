<script setup lang="ts">
  import { ref } from 'vue'
  import { RouterLink } from 'vue-router'

  const openCategoryMenu = ref<boolean>(false)
  const openProductMenu = ref<boolean>(false)
  const openSupplierMenu = ref<boolean>(false)
  const openPurchaseMenu = ref<boolean>(false)
  const openLedgerMenu = ref<boolean>(false)
</script>

<template>
    <header class="bg-white shadow-sm flex p-2 justify-around items-center">
      <RouterLink :to="{name: 'dashboard'}" class="font-roboto text-xl uppercase text-gray-600">Laravel Vue POS</RouterLink>
      <ul class="flex items-center space-x-0.5">
        <li>
          <RouterLink :to="{name: 'dashboard'}" :class="[$route.name === 'dashboard' ? 'bg-indigo-600 text-white' : 'text-gray-600']" class="px-4 py-3.5 font-roboto">Dashboard</RouterLink>
        </li>
        <li>
          <a href="" :class="[$route.name === 'category-list' || $route.name === 'create-category' || $route.name === 'update-category' ? 'bg-indigo-600 text-white' : 'text-gray-600']" class="px-4 py-3.5 relative font-roboto" @click.prevent="openCategoryMenu = !openCategoryMenu">Category</a>
          <ul v-if="openCategoryMenu" class="absolute bg-white mt-3 p-3 border border-gray-100">
            <li><RouterLink :to="{name: 'category-list'}" class="flex font-roboto text-gray-600 px-4 py-1.5 hover:bg-gray-100 hover:rounded-2xl">Category List</RouterLink></li>
            <li><RouterLink :to="{name: 'create-category'}" class="flex font-roboto text-gray-600 px-4 py-1.5 hover:bg-gray-100 hover:rounded-2xl">Create new Category</RouterLink></li>
          </ul>
        </li>
        <li>
          <a href="" :class="[$route.name === 'product-list' || $route.name === 'create-product' || $route.name === 'update-product' ? 'bg-indigo-600 text-white' : 'text-gray-600']" class="px-4 py-3.5 relative font-roboto" @click.prevent="openProductMenu = !openProductMenu">Product</a>
          <ul v-if="openProductMenu" class="absolute bg-white mt-3 p-3 border border-gray-100">
            <li><RouterLink :to="{name: 'product-list'}" class="flex font-roboto text-gray-600 px-4 py-1.5 hover:bg-gray-100 hover:rounded-2xl">Product List</RouterLink></li>
            <li><RouterLink :to="{name: 'create-product'}" class="flex font-roboto text-gray-600 px-4 py-1.5 hover:bg-gray-100 hover:rounded-2xl">Create new Product</RouterLink></li>
          </ul>
        </li>
        <li>
          <a href="" :class="[$route.name === 'supplier-list'  || $route.name === 'create-supplier' || $route.name === 'update-supplier' ? 'bg-indigo-600 text-white' : 'text-gray-600']" class="px-4 py-3.5 relative font-roboto" @click.prevent="openSupplierMenu = !openSupplierMenu">Supplier</a>
          <ul v-if="openSupplierMenu" class="absolute bg-white mt-3 p-3 border border-gray-100">
            <li><RouterLink :to="{name: 'supplier-list'}" class="flex font-roboto text-gray-600 px-4 py-1.5 hover:bg-gray-100 hover:rounded-2xl">Supplier List</RouterLink></li>
            <li><RouterLink :to="{name: 'create-supplier'}" class="flex font-roboto text-gray-600 px-4 py-1.5 hover:bg-gray-100 hover:rounded-2xl">Create new Supplier</RouterLink></li>
          </ul>
        </li>
        <li>
          <a href="" :class="[$route.name === 'purchase-order-list' || $route.name === 'create-purchase-order' || $route.name === 'purchase-order-detail' ? 'bg-indigo-600 text-white' : 'text-gray-600']" class="px-4 py-3.5 relative font-roboto" @click.prevent="openPurchaseMenu = !openPurchaseMenu">Purchase Order</a>
          <ul v-if="openPurchaseMenu" class="absolute bg-white mt-3 p-3 border border-gray-100">
            <li><RouterLink :to="{name: 'purchase-order-list'}" class="flex font-roboto text-gray-600 px-4 py-1.5 hover:bg-gray-100 hover:rounded-2xl">Purchase List</RouterLink></li>
            <li><RouterLink :to="{name: 'create-purchase-order'}" class="flex font-roboto text-gray-600 px-4 py-1.5 hover:bg-gray-100 hover:rounded-2xl">Create new Purchase</RouterLink></li>
          </ul>
        </li> 
        <li>
          <a href="" :class="[$route.name === 'supplier-ledger-list' || $route.name === 'create-supplier-ledger' ? 'bg-indigo-600 text-white' : 'text-gray-600']" class="px-4 py-3.5 relative font-roboto" @click.prevent="openLedgerMenu = !openLedgerMenu">Supplier Ledger Order</a>
          <ul v-if="openLedgerMenu" class="absolute bg-white mt-3 p-3 border border-gray-100">
            <li><RouterLink :to="{name: 'supplier-ledger-list'}" class="flex font-roboto text-gray-600 px-4 py-1.5 hover:bg-gray-100 hover:rounded-2xl">Supplier Ledger List</RouterLink></li>
            <li><RouterLink :to="{name: 'create-supplier-ledger'}" class="flex font-roboto text-gray-600 px-4 py-1.5 hover:bg-gray-100 hover:rounded-2xl">Create new Ledger</RouterLink></li>
          </ul>
        </li>       
      </ul>
      <!-- <ul class="flex space-x-4">
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
      </ul> -->
    </header>
</template>