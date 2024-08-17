<template>
  <input :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" class="
        block w-full 
        rounded-md  py-1.5 px-2
        shadow-sm ring-1 
        ring-inset 
        focus:ring-2 focus:ring-inset 
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
        m:leading-6" />
</template>

<script>
export default {
  props: ['modelValue'],
  emits: ['update:modelValue']
}
</script>



    <!-- <div @click="typeOfShipment = list.value" v-for="(list, index) in lists" :key="index"
      :class="typeOfShipment == list.value ? 'border dark:border-tertiary-500 border-tertiary-800' : ''" class="
      grid grid-cols-12
      col-span-6
      p-3
      h-32
      bg-primary-50  
      dark:bg-secondary-900     
      border  
      border-gray-900/10 
      dark:border-gray-700 rounded-md 
    ">
      <span class="col-span-10 flex flex-col  text-justify text-gray-700 dark:text-gray-300">
        <span>{{ list.title }}</span>
        <span class="text-gray-500 dark:text-gray-400 font-normal pb-7">{{ list.days }}</span>
        <span>{{ list.price }}</span>
      </span>
      <Radio v-if="typeOfShipment == list.value" class="col-span-2 pl-5 content-between" />
    </div> -->