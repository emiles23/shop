<template>
  <div class="grid grid-cols-2 px-10 sm:px-0 ">
    <h2 class="text-lg font-medium text-gray-800 dark:text-gray-300" id="slide-over-title">Carrito de compra</h2>
    <div class="ml-3 flex h-7 justify-end">
      <button @click="show = false" type="button" class="-m-2 p-2 text-gray-400 hover:text-gray-500">
        <Close />
      </button>
    </div>
  </div>
</template>

<script>
import Close from "./icons/Close.vue";
import { mapWritableState } from 'pinia'
import { useShoppingCartStoreStore } from "../store/shoppingCartStore.js"

export default {
  components: {
    Close
  },

  computed: {
    ...mapWritableState(useShoppingCartStoreStore, ['show']),
  }
}
</script>