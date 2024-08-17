<template>
    <button class="             
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
        flex gap-3
        ">
       <component :is="icon" > </component>
       <slot></slot> 
    </button>
</template>

<script>

export default {

  props:{
    icon:{
      type:Function,
      default: null
    }
  }
}
</script>