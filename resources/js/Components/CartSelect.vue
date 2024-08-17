<template>
    <div @click="$emit('update:modelValue', option.value)"
      :class="modelValue == option.value ? 'border-2 dark:border-tertiary-500 border-tertiary-800' : ''" class="
      relative     
      p-2
      bg-primary-50  
      dark:bg-secondary-900     
      border  
      border-gray-900/10 
      dark:border-gray-700 rounded-md 
      cursor-pointer
    ">
      <slot></slot>
      <!-- <Radio v-if="modelValue == option.value" class="absolute right-3 top-3" /> -->
    </div>
</template>

<script>
// import Radio from "../components/icons/Radio.vue";
export default {
  components: {
    // Radio,
  },
  props: ['modelValue', 'option'], 
  emits: ['update:modelValue'],
  data() {
    return {
      // value: this.modelValue
    }
  }
}
</script>