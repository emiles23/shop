<template>
  <div v-if="show">
    <div v-if="elementCart()" class="
        drop-shadow-md      
        absolute 
        right-0 
        top-20
        w-96   
        z-10 ">
      <h1 class="
        text-secondary-600
        bg-primary-50
        dark:bg-secondary-900
        dark:text-primary-300
        text-base 
        text-center 
        py-6">Tu bolsa esta vacia
      </h1>
    </div>
    <div v-if="!elementCart()" class=" relative z-10">
      <div class="
        fixed inset-0 
        bg-secondary-800
        bg-opacity-75 
        transition-opacity">
      </div>
      <ModalCart>
        <CartHeader class="mt-4" />
        <!-- products... -->
        <div class="mt-3">
          <SummaryProductCard v-for="(product, index) in products" :key="index" :product="product" :index="index" />
        </div>
        <!-- end products... -->
        <!-- discounts -->
        <div class="         
          text-secondary-600 
          dark:text-secondary-400
          border-primary-200
          dark:border-secondary-500
          border-t 
          px-4
          py-6 
          sm:px-6
          text-justify      
          text-sm       
          ">
          <div class="pb-20 px-5 sm:px-0 sm:pb-32 md:pb-10 lg:pb-24">
            <div v-if="discountsApplied" class="text-secondary-600 dark:text-secondary-400">
              <div v-for="(discount, index) in discountsApplied" :key="index" class="pb-4">
                <span v-if="discount.remainingForDiscount > 0">
                  Obten un descuento del
                  <span>{{ discount.value }}%</span>
                  por llevar <span class="font-extrabold"> ${{ discount.min }}</span>
                  en la marca
                  <span class="font-extrabold">{{ discount.brand }}</span>
                  faltan <span class="font-extrabold"> ${{ discount.remainingForDiscount.toFixed(2) }}</span>
                </span>
                <span v-else class="text-tertiary-700 dark:text-tertiary-500">
                  Se ha aplicado un descuento del
                  <span class=" text-red-500">{{ discount.value }}%</span>
                  por llevar <span class="font-extrabold"> ${{ discount.totalPaymentPerBrand.toFixed(2)
                  }}</span>
                  en la marca
                  <span class="font-extrabold">{{ discount.brand }}</span>
                </span>
              </div>
            </div>

            <div v-for="(discount, index) in discountGroups" :key="index" class="pb-5">
              <span v-if="isGroupDiscountApplicable(discount)" class="text-tertiary-700 dark:text-tertiary-500">
                Se ha aplicado un descuento del <span class=" text-red-500">{{
                  getDiscountGroupsRepresentation(discount)
                }}</span> por
                llevar las marcas <span class="font-extrabold">{{ discount.brands.join(', ') }}</span>
              </span>
              <TextDiscountGroups v-else :discount="discount" />
            </div>
          </div>
          <!-- total and subtotal -->
          <SubtotalTotal class="
            fixed 
            w-96
            py-6  
            right-0    
            px-9 
            bottom-0 
            z-20            
            shadow-xl 
            border-t 
            border-primary-300
            dark:border-secondary-500
            bg-white
            dark:bg-secondary-900
            ">
            <!-- <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at checkout.</p> -->
            <div class="mt-6 ">
              <CustomButton @click="() =>
                $router.push('/checkout')">Checkout</CustomButton>
            </div>
            <div class="
              mt-6 
              flex 
              justify-center 
              text-center 
              text-sm 
            text-secondary-500">
              <DeleteAllCart v-if="!elementCart()" @click="deleteAll()" />
            </div>
          </SubtotalTotal>
        </div>
        <!-- total -->

      </ModalCart>
    </div>
  </div>
</template>

<script>

import Delete from "./icons/Delete.vue";
import TextDiscountGroups from "./TextDiscountGroups.vue";
import SummaryProductCard from "./SummaryProductCard.vue";
import ModalCart from "./ModalCart.vue";
import CartHeader from "./CartHeader.vue";
import SubtotalTotal from "./SubtotalTotal.vue";
import CustomButton from "./CustomButton.vue";
import DeleteAllCart from "./DeleteAllCart.vue";
// pinia
import { mapState, mapActions, mapWritableState } from 'pinia'
import { useShoppingCartStoreStore } from "../store/shoppingCartStore.js"
import { useDefinitionsStore } from "../store/definitions.js"

export default {

  components: {
    Delete,
    TextDiscountGroups,
    SummaryProductCard,
    ModalCart,
    CartHeader,
    CustomButton,
    DeleteAllCart,
    SubtotalTotal

  },
  methods: {

    ...mapActions(useDefinitionsStore, ['getDiscountGroupsRepresentation']),
    ...mapActions(useShoppingCartStoreStore,
      [
        'getDiscountsApplied',
        'elementCart',
        'getTheGroupDiscount',
        'subtotal',
        'totalPerBrand',
      ]
    ),

    // BOOLEANO

    deleteAll() {
      return this.products = []
    },

    isGroupDiscountApplicable(discount) {
      let group = this.getTheGroupDiscount()[0]
      let subtotal = this.subtotal()
      return subtotal >= discount.min && group.length >= discount.quantity ? true : false
    },

    getPendingAmountToPayPerBrand(discount) {
      return discount.min - this.totalPerBrand(discount)
    },

  },

  watch: {
    products(newValue) {
      localStorage.setItem('cartPruducts', JSON.stringify(newValue))
    }
  },
  computed: {
    ...mapState(useDefinitionsStore, ['discountGroups', 'discounts']),
    ...mapWritableState(useShoppingCartStoreStore, ['products', 'show']),
    discountsApplied() {
      return this.getDiscountsApplied().map(discount => {
        discount.remainingForDiscount = this.getPendingAmountToPayPerBrand(discount)
        discount.totalPaymentPerBrand = this.totalPerBrand(discount)
        return discount
      })
    },

  }
}
</script>

<style scoped>
.max-h-screen-80 {
  max-height: 85vh;
}
</style> 
