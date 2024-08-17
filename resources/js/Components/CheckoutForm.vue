<template>
  <BasicForm :rows="rows" :buttonTitle="buttonTitle" />
</template>
<script>
import BasicForm from "../components/BasicForm.vue";
import PaypalButton from "../components/PaypalButton.vue";

export default {

  components: {
    BasicForm,
    PaypalButton
  },
  data() {
    return {
      // typeOfShipment: null,
      buttonTitle:'Procesar Pedido',
      rows: [
        // Delivery method 
        {
          class: 'col-span-12',
          title:'Información de Contacto',
          fields: [
            { name: 'email', label: 'Dirección de correo electrónico', type: 'email', value: '' },
          ]
        },

        {
          class: 'col-span-12 sm:col-span-6',
          subTitle: 'Información de envío',
          fields: [
            { name: 'Nombre', label: 'Nombre', type: 'text', value: '' },
            { name: 'Apellido', label: 'Apellido', type: 'text', value: '' },
          ]
        },
        {
          class: 'col-span-12 sm:col-span-6 mt-4',
          fields: [
            { name: 'Apellido', label: 'Empresa', type: 'text', value: '' },
            { name: 'Apellido', label: 'Dirección', type: 'text', value: '' },
          ]
        },

        {
          class: 'col-span-12 sm:col-span-4  mt-6',
          fields: [
            {
              type: 'select',
              label: 'País',
              selected: 'A',
              disabled: 'Seleccione un País',
              options: [
                { text: 'One', value: 'A' },
                { text: 'Two', value: 'B' },
                { text: 'Three', value: 'C' }
              ]
            },
            {
              type: 'select',
              label: 'Ciudad',
              selected: 'A',
              disabled: 'Seleccione una Ciudad',
              options: [
                { text: 'One', value: 'A' },
                { text: 'Two', value: 'B' },
                { text: 'Three', value: 'C' }
              ],
            },
            {
              type: 'select',
              label: 'Estado',
              selected: 'A',
              disabled: 'Seleccione un Estado',
              options: [
                { text: 'One', value: 'A' },
                { text: 'Two', value: 'B' },
                { text: 'Three', value: 'C' }
              ]
            }
          ],
        },

        {
          class: 'col-span-12 sm:col-span-6 mt-4',
          fields: [
            { name: 'Apellido', label: 'Código postal', type: 'text', value: '' },
            { name: 'Apellido', label: 'Apartamento, suite, etc.', type: 'text', value: '' },
          ]
        },
        {
          class: 'col-span-12 mt-4',
          fields: [
            { name: 'Apellido', label: 'Teléfono', type: 'text', value: '' },
          ]
        },

        // Shipping Method

        {
          class: 'col-span-12',
          subTitle: 'Método de entrega',
          fields: [
            {
              type: 'CartSelect',
              value: 0,
              options: [
                { subTitle: 'Estándar', days: '4-10 días laborables', price: '$5.00', value: 0 },
                { subTitle: 'Express', days: '2-5 días laborables', price: '$16.00', value: 1 },
              ]
            }
          ]
        },

        // Payment Method 
        {
          class: 'col-span-12 flex w-full gap-12',
          subTitle: 'Método Pago',
          fields: [
            {
              name: 'paymentType',
              label: 'Tipo de Pago',
              type: 'radio',
              value: 0,
              options: [
                { label: 'Tarjeta de crédito', value: 0 },
                { label: 'PayPal', value: 1 },
                { label: 'eTransfer', value: 2 },
              ]
            }
          ]
        },

        {
          showIf: {
            name: 'paymentType',
            value: 0,
          },
          class: 'col-span-12 my-3',
          fields: [
            { name: 'card-number', label: 'Número de tarjeta', type: 'text', value: '', },
            { name: 'name-on-card', label: 'Nombre en la tarjeta', type: 'text', value: '' },
          ]
        },

        {
          showIf: {
            name: 'paymentType',
            value: 0,
          },
          class: 'col-span-12 sm:col-span-6 mt-4',
          fields: [
            { name: 'expiration-date', label: 'Fecha de caducidad (MM/AA)', type: 'date', value: '', },
            { name: 'cvc', label: 'CVC', type: 'text', value: '' },
          ]
        },

        {
          showIf: {
            name: 'paymentType',
            value: 1,
          },
          class: 'col-span-12 mt-10 flex justify-center ',
          fields: [
            // mejorar este tipo de componente
            { name: PaypalButton, type: 'component' },
          ]
        },
      ]
    }
  },
}
</script>