<template>
  <div class="
        flex 
        flex-1 
        items-end 
        justify-between 
        text-sm">
    <p class="text-secondary-500 dark:text-primary-300">Qty {{ product.quantity }}</p>
    <div class="flex gap-7">
      <button @click="add(product)" type="button" class="
         font-medium 
        text-tertiary-600
        hover:text-tertiary-700 
        dark:text-tertiary-500 
        dark:hover:text-tertiary-400">Agregar
      </button>
      <button @click="deleteCart(product)" type="button" class="font-medium text-red-500 hover:text-red-700">
        <Delete class="w-5 h-5"></Delete>
      </button>
    </div>
  </div>
</template>

<script>

import Delete from "./icons/Delete.vue";

//pinia
import { mapWritableState, mapActions, } from 'pinia'
import { useShoppingCartStoreStore } from "../store/shoppingCartStore.js"

export default {
  components: {
    Delete
  },

  props: {
    product: {
      default: {},
    },
    index: {
      default: 0,
    },
  },

  methods: {
    ...mapActions(useShoppingCartStoreStore, ['add']),

    deleteCart(productToDelete) {

      if (productToDelete.quantity > 1) {
        productToDelete.quantity--
        return
      }

      this.products = this.products.filter((product) => product.name != productToDelete.name);
    },
  },
  computed: {
    ...mapWritableState(useShoppingCartStoreStore, ['products']),
  }
}
</script>