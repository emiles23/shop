<template>
  <div class="text-gray-500">
    <div class="
        absolute
        text-gray-500 
        right-0
        z-10 
        mt-2 
        w-56 
        origin-top-right 
        rounded-md 
        bg-white 
        shadow-lg 
        ring-1 
        ring-black
        ring-opacity-5 
        focus:outline-none 
        text-justify
        p-3">
      <div v-for="(discount, index) in definitions.discountGroups" :key="index">
        <span v-if="discount.brands.includes(product.brand)">
          Por la compra mínima de <span class="font-extrabold">${{ discount.min
          }}</span>
          incluyendo {{ discount.quantity }} productos distintos de las marcas
          <span class="font-extrabold">{{ discount.brands.join(', ') }}</span>, se
          aplicara un
          descuento de

          <span class="font-extrabold text-red-400">{{
            getDiscountGroupsRepresentation(discount)
          }}</span>

          tu factura total
        </span>

      </div>
    </div>
  </div>
</template>

<script>
import { definitions } from "../store.js";
export default {
  props: {
    product: {
      default: {},
    },
  },

  data() {
    return {
      definitions
    }
  },
  methods: {
    getDiscountGroupsRepresentation(discount) {
      var textDiscount = '-'

      if (discount?.type === 'flat') {
        textDiscount += `$${discount.value}`
      }
      else {
        textDiscount += `${discount.value}%`
      }

      return textDiscount
    },

  }
}
</script>