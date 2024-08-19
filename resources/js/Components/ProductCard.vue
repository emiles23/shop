<template>
  <div class="group relative pb-10">
    <!-- img -->
    <div class="         
          aspect-h-1 
         aspect-w-1 
         w-full 
         overflow-hidden 
         rounded-md 
         bg-gray-200 
         lg:aspect-none 
         group-hover:opacity-75
         h-72
         sm:h-80">
      <img @click="() => {
        $router.push({
          name: 'Producto',
          params: {
            id: product.id
          }
        })
      }" :src="product.img" class=" 
        h-full 
        w-full 
        object-cover 
        object-center 
        lg:h-full 
        lg:w-full">
    </div>
    <!-- end img -->
    <div class="
        mt-4
        gap-4
        grid 
        px-3
        pt-5
        pb-10
        grid-cols-12  
        text-secondary-600 
        dark:text-primary-300
        text-base
        
        capitalize">
      <div class="col-span-7 ">
        <p class="pb-14">{{ product.name }} </p>
      </div>
      <p class="absolute left-5 bottom-20">{{ product.brand.name }}</p>
      <div class="col-span-5 ">
        <!-- <template v-if="isGroupDiscountAvailable(product)">
          <div class="flex gap-2 justify-between pb-5">
            <h1 @mouseover="showDiscountDropDown = true" @mouseleave="showDiscountDropDown = false"
              class="text-secondary-500 dark:text-primary-300 text-sm cursor-pointer">Descuento</h1>
            <Question @mouseover="showDiscountDropDown = true" @mouseleave="showDiscountDropDown = false" class="    
                h-5 
                p-1 
                text-gray-500 
                bg-gray-200 
                shadow-lg 
                rounded-full 
                cursor-pointer 
                hover:bg-gray-300 " />
          </div>
          <DropDownBase v-if="showDiscountDropDown" class="
              absolute 
              origin-top-right 
              right-0 
              z-10
              mt-8 ">

            <TextDiscountGroups
              v-for="(discount, index) in discountGroups.filter(discount => discount.brands.includes(product.brand))"
              :key="index" :discount="discount" :class="index % 2 == 1 ? 'py-3' : ''" />
          </DropDownBase>
        </template> -->
        <!-- <ProductPrice :product="product" class=" text-sm" /> -->
        <h1 class="flex justify-end">${{ product.price }}</h1>
      </div>
    </div>
    <BasicButton @click="add(product)" class="absolute left-24 sm:left-16 2xl:left-24 bottom-5 px-5 text-sm">Agregar al
      Carrito</BasicButton>
  </div>
  <!-- More products... -->
</template>

<script>

import DropDownBase from '@/Components/DropDownBase.vue';
import BasicButton from '@/Components/BasicButton.vue'
import ProductPrice from '@/Components/ProductPrice.vue'
import TextDiscountGroups from '@/Components/TextDiscountGroups.vue';
import Question from '@/Components/icons/Question.vue';


//  'pinia'
import { mapActions, mapState, mapWritableState } from 'pinia'
import { useShoppingCartStoreStore } from "../store/shoppingCartStore.js"
import { useDefinitionsStore } from "../store/definitions.js"
import { useTabsStore } from "../store/tabs.js"

export default {

  components: {
    DropDownBase,
    Question,
    TextDiscountGroups,
    ProductPrice,
    BasicButton
  },

  props: {
    product: {
      default: {},
    },

  },

  data() {
    return {
      showDiscountDropDown: false,
    }
  },


  methods: {
    ...mapActions(useShoppingCartStoreStore, ['add']),
    isGroupDiscountAvailable(product) {
      return this.discountGroups.find(group => group.brands.includes(product.brand)) ? true : false
    },
  },

  computed: {
    ...mapState(useDefinitionsStore, ['discounts', 'discountGroups']),
    ...mapWritableState(useTabsStore, ['currentTab', 'tabs']),
  }
}
</script>

<style>
.brand-name-container-size {
  min-height: 100px;
  max-height: 100px;
}
</style>