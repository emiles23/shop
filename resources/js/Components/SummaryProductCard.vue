<template>
  <div class="flow-root">
    <ul class="text-secondary-600 dark:text-primary-300">
      <li :class="index > 0 ? 'border-t border-primary-200 dark:border-secondary-600' : ''"
        class="grid grid-cols-12 gap-x-4 py-8 mt-4 px-5 sm:px-0">
        <div class="
             col-span-4            
              border                    
            border-x-primary-200                   
            ">
          <img :src="product.img">
        </div>
        <div class="col-span-8">
          <h1 class="text-sm sm:text-base">
            <a href="#">{{ product.name }}</a>
          </h1>
          <ProductPrice :product="product" class=" text-sm" />
          <p class="
              my-2
              text-sm                                  
              capitalize">
            {{ product.brand }}
          </p>
          <ProductQuantityHandlers :product="product" />
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
import ProductQuantityHandlers from "./ProductQuantityHandlers.vue"
import ProductPrice from "./ProductPrice.vue"

export default {
  components: {
    ProductQuantityHandlers,
    ProductPrice
  },

  props: {
    product: {
      default: {},
    },
    index: {
      default: 0,
    },
  },
}
</script>