<template>
  <select :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" class="   
      block 
      w-full
      rounded-md  
      py-1.5 
      px-3
      shadow-sm 
      ring-1                
      ring-inset               
      focus:ring-2 
      focus:ring-inset             
      ring-gray-300               
      dark:bg-secondary-900                
      placeholder:text-gray-400               
      focus:ring-tertiary-800                
      focus:text-secondary-600              
      hover:text-tertiary-800                   
      text-secondary-600                    
      border-primary-300                     
      dark:border-gray-800             
      dark:text-primary-300               
      sm:text-sm              
      h-9 
      cursor-pointer              
      m:leading-6">
    <slot></slot>
  </select>
</template>

<script>
export default {
  props: ['modelValue'],
  emits: ['update:modelValue']
}
</script>
