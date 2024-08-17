import { defineStore } from 'pinia'
import { useSearchEngineStore } from "../store/searchEngine.js"

export const useDefinitionsStore = defineStore('definitions', {

  state: () => ({
    discounts: [
      {
        id: 1,
        brand: "Samsung",
        min: 1000,
        value: 10,

      },
      {
        id: 2,
        brand: "Shein",
        min: 45,
        value: 30,
        products: [
          {
            name: 'Pantalones jogger',
            value: 20,
            min: 0
          },

          {
            name: 'Blazer unicolor',
            type: 'flat',
            value: 5,
            min: 0
          },

        ]
      },
      {
        id: 3,
        brand: "Dell",
        min: 800,
        value: 12,

        products: [
          {
            name: 'Computadora OptiPlex personalizada de escritorio Intel Core i5-6500',
            value: 30,
            min: 0
          },

        ]
      },
      {
        id: 4,
        brand: "Adidas",
        min: 300,
        value: 15
      },
      {
        id: 5,
        brand: "Rucha",
        min: 100,
        value: 5
      },

    ],

    discountGroups: [
      {
        id: 1,
        brands: ['Shein', 'Rucha', 'Adidas'],
        quantity: 3,
        value: 5,
        min: 400
      },
      {
        id: 2,
        brands: ['Samsung', 'Adidas', 'Shein'],
        quantity: 2,
        value: 200,
        min: 1500,
        type: 'flat',
      }
    ],

    products: [
      {
        id: 1,
        name: 'Franela',
        brand: 'Shein',
        price: 12,
        img: "/img/products/shein/img1.jpg",
        value: 0,
        images: [
          { img: "/img/products/shein/img1.jpg", value: '0' },
          { img: "/img/products/shein/img2.jpg", value: '1' },
          { img: "/img/products/shein/img3.jpg", value: '2' },
        ],

        options: [
          { size: 'XXS', value: 0 },
          { size: 'XS', value: 1 },
          { size: 'S', value: 2 },
          { size: 'M', value: 3 },
          { size: 'L', value: 4 },
          { size: 'XL', value: 5 },
        ],

        descriptions: [
          { key: 'Tipo de manga:', val: 'Manga normal' },
          { key: 'Color:', val: 'Multicolorl' },
          { key: 'Tipo de patrón:', val: 'Liso' },
          { key: 'Escote:', val: 'Cuello redondo' },
          { key: 'Longitud de la manga:', val: 'Corto' },
          { key: 'Largo Tops:', val: 'Corto' },
          { key: 'Tipo de corte:', val: 'Corte normal' },
          { key: 'Tejido:', val: 'Estiramiento medio' },
          { key: 'Material :', val: 'Manga normal' },
          { key: 'Material de la parte superior:', val: 'Tejido de punto' },
        ],
      },

      {
        id: 2,
        name: 'Camisa sin manga',
        brand: 'Shein',
        price: 12,
        img: "/img/store/img1.png",
        value: 0,
        images: [
          { img: "/img/products/shein/img3.jpg", value: '0' },
          { img: "/img/products/shein/img2.jpg", value: '1' },
          { img: "/img/products/shein/img1.jpg", value: '2' },

        ],
        options: [
          { size: 'XXS', value: 0 },
          { size: 'XS', value: 1 },
          { size: 'S', value: 2 },
          { size: 'M', value: 3 },
          { size: 'L', value: 4 },
          { size: 'XL', value: 5 },
        ],
        descriptions: [
          { key: 'Tipo de manga:', val: 'Manga normal' },
          { key: 'Color:', val: 'Multicolorl' },
          { key: 'Tipo de patrón:', val: 'Liso' },
          { key: 'Escote:', val: 'Cuello redondo' },
          { key: 'Longitud de la manga:', val: 'Corto' },
          { key: 'Largo Tops:', val: 'Corto' },
          { key: 'Tipo de corte:', val: 'Corte normal' },
          { key: 'Tejido:', val: 'Estiramiento medio' },
          { key: 'Material :', val: 'Manga normal' },
          { key: 'Material de la parte superior:', val: 'Tejido de punto' },
        ],
      },
      {
        id: 3,
        name: 'Blazer unicolor',
        brand: 'Shein',
        price: 15,
        img: "/img/store/img2.png"
      },
      {
        id: 4,
        name: 'Pantalones jogger',
        brand: 'Shein',
        price: 18,
        img: "/img/store/img3.png"
      },
      {
        id: 5,
        name: '55 pulgadas Smart tv 4k',
        brand: 'Samsung', price: 799,
        img: "/img/store/img4.png"
      },
      {
        id: 6,
        name: '32 pulgadas SFire TV Omni Series ',
        brand: 'Samsung',
        price: 325,
        img: "/img/store/img5.png"
      },
      {
        id: 7,
        name: '75 pulgadas, clase Crystal UHD, serie AU8000, 4K, UHD, HDR, Smart TV',
        brand: 'Samsung',
        price: 500,
        img: "/img/store/img6.png"
      },

      {
        id: 8,
        name: '(AMD Ryzen 5 5600X, RTX 3060, 16GB 3600Mhz',
        brand: 'Dell',
        price: 300,
        img: "/img/store/img7.png"
      },
      {
        id: 9,
        name: 'Computadora OptiPlex personalizada de escritorio Intel Core i5-6500',
        brand: 'Dell',
        price: 23,
        img: "/img/store/img8.png"
      },
      {
        id: 10,
        name: 'procesador Intel Core i7-11700F, GeForce RTX 3060, 32 GB de RAM, 1 TB ',
        brand: 'Dell',
        price: 600,
        img: "/img/store/img9.png"
      },

      {
        id: 11,
        name: 'Zapatos deportivos de correr para hombre',
        brand: 'Adidas',
        price: 300,
        img: "/img/store/img10.png"
      },
      {
        id: 12,
        name: 'Tenis para correr para mujer',
        brand: 'Adidas',
        price: 150,
        img: "/img/store/img11.png"
      },
      {
        id: 13,
        name: 'Zapatos planos Belice estilo ballet para mujer',
        brand: 'Adidas',
        price: 185,
        img: "/img/store/img12.png"
      },

      {
        id: 14,
        name: 'Plancha De Cabello Professional 450°F, plancha de pelo de cerámica ',
        brand: 'Rucha',
        price: 260,
        img: "/img/store/img13.png"
      },
      {
        id: 15,
        name: 'Conair Plancha plana de cerámica doble, 1 pulgada',
        brand: 'Rucha',
        price: 20,
        img: "/img/store/img14.png"
      },
      {
        id: 16,
        name: 'Titanium Ionic Hair Straightener, Professional Flat Iron For All Hair+ Types',
        brand: 'Rucha',
        price: 10,
        img: "/img/store/img15.png"
      },

    ],
  }),

  actions: {
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



    getDiscountProductObject(product) {
      return this.discounts.find(discount => discount.brand == product.brand)?.products
        ?.find(productDiscount => productDiscount.name == product.name)
    },

    getProductDiscount(product) {
      var discount = 0
      var discountProductObject = this.getDiscountProductObject(product)

      if (discountProductObject) {
        if (discountProductObject?.type === 'flat') {
          discount = discountProductObject.value
        }
        else {
          discount = product.price * (discountProductObject.value / 100)
        }
      }
      return discount
    },

    getDiscountedPrice(product) {
      return product.price - this.getProductDiscount(product)
    },

    getDiscountRepresentation(product) {
      var textDiscount = '-'
      var discountObject = this.getDiscountProductObject(product)
      var value = discountObject?.value

      if (discountObject?.type === 'flat') {
        textDiscount += `$${value}`
      }
      else {
        textDiscount += `${value}%`
      }
      return textDiscount
    },

    getProductById(id) {
      return this.productsWithDicount.find((product) => product.id == id)
    }
  },

  getters: {
    productsWithDicount(state) {
      const searchEngineStore = useSearchEngineStore();
        return state.products.filter(product => product.name.toLowerCase().includes(searchEngineStore.search.toLowerCase())).map(product => {
        product.discountedPrice = this.getDiscountedPrice(product)
        product.productDiscount = this.getProductDiscount(product)
        product.discountRepresentation = this.getDiscountRepresentation(product)
        return product
      })
    },
  }

})