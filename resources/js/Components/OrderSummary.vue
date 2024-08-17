<template>
  <BasicCard>
    <div v-if="!elementCart()">
      <div class="            
            overflow-y-auto 
            max-h-screen
            px-0 
            sm:px-5             
      ">
        <SummaryProductCard v-for="(product, index) in products" :key="index" :product="product" :index="index" />
      </div>
      <div class="
          p-8
          sm:px-5
          sm:py-20
          border-t  
          border-secondary-800                                            
          leading-loose                               b
      ">
        <SubtotalTotal />
      </div>
    </div>
    <div v-else class="
        h-96 flex 
        justify-center 
        items-center text-xl  
        dark:text-primary-300 
        text-secondary-600">
      <h1>Tu bolsa esta vacia</h1>
    </div>
  </BasicCard>
</template>

<script>

import SummaryProductCard from "./SummaryProductCard.vue";
import SubtotalTotal from "./SubtotalTotal.vue";
import CustomButton from "./CustomButton.vue";
import BasicCard from "./BasicCard.vue";
// pinia
import { mapWritableState, mapActions } from 'pinia'
import { useShoppingCartStoreStore } from "../store/shoppingCartStore.js"
export default {

  components: {
    SubtotalTotal,
    SummaryProductCard,
    CustomButton,
    BasicCard
  },

  computed: {
    ...mapWritableState(useShoppingCartStoreStore, ['products']),

  },

  methods: {
    ...mapActions(useShoppingCartStoreStore, ['elementCart',]),

  },
}
</script>



<style scoped>
/* .max-h-screen-45 {
  max-height: 90vh;
} */

.max-h-screen-70 {
  max-height: 83vh;
}

/* 
.min-h-screen-20 {
  min-height: 20vh;
} */
</style> 