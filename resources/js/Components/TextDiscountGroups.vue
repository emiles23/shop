<template>
  <div class="text-gray-500  dark:text-gray-400">
    - Por la compra mínima de <span class="font-extrabold">${{ discount.min
    }}</span>
    incluyendo {{ discount.quantity }} productos distintos de las marcas
    <span v-if="discount.brands?.length > 0" class="font-extrabold">{{ discount.brands.join(', ') }}</span>, se
    aplicara un
    descuento de
    <span class="font-extrabold text-red-400">
      {{ getDiscountGroupsRepresentation(discount) }}
    </span>
    tu factura total
  </div>
</template>

<script>

export default {
  props: {
    discount: {
      default: {},
    },

    index: {
      default: 0
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

  },

}
</script>