<template>
  <form class=" sm:text-sm  text-gray-700 
        dark:text-gray-300  font-semibold  leading-7 ">
    <div v-for="(row, index) in rows" :key="index" class="grid grid-cols-12 gap-4">

      <template v-if="!row.showIf || findField(row.showIf.name).value === row.showIf.value">
        <h1 v-if="row.title" class="
          col-span-12 
          mb-5
          text-xl  
        ">
          {{ row.title }}
        </h1>
        <h1 v-if="row.subTitle" class="
          col-span-12 
          mt-12
          mb-5
          text-lg   
          pt-10
          border-t 
          dark:border-secondary-800
        ">
          {{ row.subTitle }}
        </h1>

        <div v-for="(field, index) in row.fields" :class="row.class" class="block text-sm font-medium">

          <div v-if="field.type === 'radio'" class="">
            <label class="leading-10"> {{ field.label }} </label>
            <div class="sm:flex">
              <div v-for="(option, index) in field.options" class="flex mr-4">
                <input v-model="field.value" :type="field.type" :value="option.value" class="cursor-pointer" />
                <label class="pl-2">{{ option.label }}</label>
              </div>
            </div>
          </div>


          <div v-else-if="field.type === 'select'">
            <label class="leading-10">{{ field.label }}: {{ field.selected }}</label>
            <FieldSelect v-model="field.selected">
              <option disabled value="">{{ field.disabled }}</option>
              <option v-for="(option, index) in field.options" :key="index" :value="option.value">{{ option.value }}
              </option>
            </FieldSelect>
          </div>

          <div v-else-if="field.type === 'CartSelect'" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <CartSelect v-for="(option, index) in field.options" :key="index" :option="option" v-model="field.value"
              class="h-32">
              <span class="flex flex-col text-justify">
                <span>{{ option.subTitle }}</span>
                <span class="text-gray-500 dark:text-gray-400 font-normal pb-7">{{ option.days }}</span>
                <span>{{ option.price }}</span>
              </span>
              <Radio v-if=" field.value == option.value" class="absolute right-3 top-3" />
            </CartSelect>
          </div>

          <component v-else-if="field.type === 'component'" :is="field.name"></component>

          <div v-else>
            <label class="leading-10">{{ field.label }}</label>
            <FieldText v-model="field.value" :type="field.type" />
          </div>

        </div>
      </template>
    </div>
    <CustomButton class="mt-10">{{ buttonTitle }}</CustomButton>
  </form>
</template>

<script>
import FieldText from "./FieldText.vue";
import FieldSelect from "./FieldSelect.vue";
import CartSelect from "./CartSelect.vue";
import BasicButton from "./BasicButton.vue";
import CustomButton from "./CustomButton.vue";
import Radio from "./icons/Radio.vue";
import Paypal from "./icons/Paypal.vue";


export default {

  components: {
    FieldText,
    FieldSelect,
    CartSelect,
    BasicButton,
    CustomButton,
    Paypal,
    Radio,
  },

  // props: [
  //   'rows',
  //   'buttonTitle'
  // ],

  props: {
    rows: {
      type: Array,
      default: []
    },
    buttonTitle: {
      type: String,
      default: ''
    }
  },

  methods: {
    findField(name) {
      return this.rows.reduce((arr, row) => [...arr, ...row.fields], []).find(field => field.name === name)
    }
  },

  computed: {
    fields() {
      return this.rows.reduce((arr, row) => [...arr, ...row.fields], [])
    }
  },
}
</script>
