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
      <img @click="false" :src="product.img" class=" 
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
      <div class="col-span-7">
        <p class="pb-14">{{ product.name }} </p>
        <p class="absolute left-5 bottom-20">{{ product.brand.name }}</p>
      </div>

      <div class="col-span-3 text-end w-36 pr-5">
        <!-- Descuento -->
        <div class="flex justify-end gap-3 pb-5">
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
        </DropDownBase>

        <!-- Precio -->
        <div v-if="hasDiscount" class="flex justify-end gap-x-3">
          <!-- 1. Precio tachado (antiguo) -->
          <p class="line-through decoration text-secondary-400">
            ${{ product.price }}
          </p>
          <!-- 2. Descuento -->
          <p class="text-red-500">
            {{ getDiscountRepresentation(discount) }}
          </p>
        </div>
        <!-- 3. Precio con descuento aplicado -->
        <p>
          ${{ discountedPrice }}
        </p>
      </div>

    </div>
    <Link :href="route('cart.store')" method="post" :data="{ product_id: product.id, quantity: 1 }" as="button"
      preserve-scroll class="btn btn-primary 
        absolute 
        sm:
        left-16 
        2xl:left-24 
        bottom-5 px-5 
        text-sm     
        py-1
        rounded-md 
        border 
        shadow-sm 
        text-secondary-800 
        border-primary-300        
        dark:border-gray-800
        dark:bg-secondary-1000
        hover:bg-primary-100
        dark:hover:bg-secondary-800
        dark:text-primary-300
        flex gap-3">
    Agregar al carrito
    </Link>

    <!-- <LoginForm/> este es el formulario personalizado de login -->
  </div>
  <!-- More products... -->
</template>

<script>

import DropDownBase from '@/Components/DropDownBase.vue';
import BasicButton from '@/Components/BasicButton.vue'
import TextDiscountGroups from '@/Components/TextDiscountGroups.vue';
import Question from '@/Components/icons/Question.vue';
// import LoginForm from "@/Components/LoginForm.vue";

import { Link } from '@inertiajs/vue3';

export default {

  components: {
    DropDownBase,
    Question,
    TextDiscountGroups,
    BasicButton,
    Link,
    // LoginForm
  },

  props: {
    product: {
      type: Object,
      required: true,
    },
  },

  data() {
    return {
      showDiscountDropDown: false,
    }
  },

  methods: {
    // getProductDiscount(product) {
    //   const value = discounts[0].value;
    //   return
    // },

    getDiscountRepresentation(discount) {
      var textDiscount = '-'
      var value = discount.value

      if (discount.type === 1) {
        textDiscount += `$${value}`
      }
      else {
        textDiscount += `${Math.round(value)}%`;
      }
      return textDiscount
    },
  },

  computed: {

    discount() {
      return this.product.discounts[0];
    },

    // Verifica si hay descuento
    hasDiscount() {
      return this.product.discounts.length > 0;
    },

    // Obtiene el valor del descuento (fijo o porcentual)
    discountValue() {
      if (!this.hasDiscount) return 0;

      const discount = this.discount; // Siempre hay un único descuento
      if (discount.type === 1) {
        // Descuento fijo
        return discount.value;
      } else if (discount.type === 0) {
        // Descuento porcentual
        return (this.product.price * discount.value) / 100;
      }
      return 0;
    },

    // Calcula el precio con el descuento aplicado
    discountedPrice() {
      if (!this.hasDiscount) return this.product.price;
      const endPrice = this.product.price - this.discountValue;
      return endPrice.toFixed(2);
    },
  },
}
</script>

<style>
.brand-name-container-size {
  min-height: 100px;
  max-height: 100px;
}
</style>