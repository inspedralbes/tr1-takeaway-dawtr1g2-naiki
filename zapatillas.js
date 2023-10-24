const { createApp } = Vue;
createApp({
    data() {
        return {
            paginaActual: 'portada',
            mostrarModalLogin: false,
            mostrarModalCorreo: false,
            "productos": [
              {
                "id": "1",
                "nombre": "Zapatos deportivos Nike Air Max 1",
                "precio": 129.99,
                "talla": "42",
                "color": "Negro"
              },
              {
                "id": "2",
                "nombre": "Zapatos deportivos Nike Air Force 1",
                "precio": 99.99,
                "talla": "41",
                "color": "Blanco"
              },
              {
                "id": "3",
                "nombre": "Zapatos deportivos Nike Free Run",
                "precio": 89.99,
                "talla": "43",
                "color": "Gris"
              },
              {
                "id": "4",
                "nombre": "Zapatos deportivos Nike React Element 55",
                "precio": 109.99,
                "talla": "44",
                "color": "Azul"
              },
              {
                "id": "5",
                "nombre": "Zapatos deportivos Nike Zoom Pegasus",
                "precio": 79.99,
                "talla": "39",
                "color": "Negro"
              },
              {
                "id": "6",
                "nombre": "Zapatos deportivos Nike Air Max 90",
                "precio": 119.99,
                "talla": "40",
                "color": "Rojo"
              },
              {
                "id": "7",
                "nombre": "Zapatos deportivos Nike Air Jordan 1",
                "precio": 149.99,
                "talla": "42",
                "color": "Negro/Rojo"
              },
              {
                "id": "8",
                "nombre": "Zapatos deportivos Nike Blazer Low",
                "precio": 69.99,
                "talla": "38",
                "color": "Blanco"
              },
              {
                "id": "9",
                "nombre": "Zapatos deportivos Nike React Infinity Run",
                "precio": 129.99,
                "talla": "41",
                "color": "Verde"
              },
              {
                "id": "10",
                "nombre": "Zapatos deportivos Nike Air Max 270",
                "precio": 109.99,
                "talla": "45",
                "color": "Negro/Azul"
              },
              {
                "id": "11",
                "nombre": "Zapatos deportivos Nike Renew Run",
                "precio": 84.99,
                "talla": "40",
                "color": "Gris/Rosa"
              },
              {
                "id": "12",
                "nombre": "Zapatos deportivos Nike Revolution 5",
                "precio": 59.99,
                "talla": "37",
                "color": "Negro/Blanco"
              },
              {
                "id": "13",
                "nombre": "Zapatos deportivos Nike Air Max Excee",
                "precio": 94.99,
                "talla": "43",
                "color": "Blanco/Azul"
              },
              {
                "id": "14",
                "nombre": "Zapatos deportivos Nike Air Zoom Pegasus 37",
                "precio": 109.99,
                "talla": "42",
                "color": "Negro/Rojo"
              },
              {
                "id": "15",
                "nombre": "Zapatos deportivos Nike Joyride Run Flyknit",
                "precio": 139.99,
                "talla": "41",
                "color": "Azul"
              },
              {
                "id": "16",
                "nombre": "Zapatos deportivos Nike Renew Retaliation TR",
                "precio": 79.99,
                "talla": "39",
                "color": "Negro/Blanco"
              },
              {
                "id": "17",
                "nombre": "Zapatos deportivos Nike Air Max 95",
                "precio": 129.99,
                "talla": "44",
                "color": "Negro/Verde"
              },
              {
                "id": "18",
                "nombre": "Zapatos deportivos Nike Joyride Dual Run",
                "precio": 119.99,
                "talla": "38",
                "color": "Gris/Rosa"
              },
              {
                "id": "19",
                "nombre": "Zapatos deportivos Nike Flex Experience RN 9",
                "precio": 64.99,
                "talla": "43",
                "color": "Negro/Azul"
              },
              {
                "id": "20",
                "nombre": "Zapatos deportivos Nike Air Max 97",
                "precio": 159.99,
                "talla": "42",
                "color": "Plata"
              }
            ]
            ,
              carrito:[],
              cantidad : 0,
              correo : ""
        };
    },
    methods: {
    mostrarBotiga() {
        this.paginaActual = 'botiga';
    },
    mostrarCheckout() {
        this.paginaActual = 'checkout';
    },
    agregarAlCarrito(producto) {
      const carrito_producto = this.carrito.find(item => item.id === producto.id);
  
      if (carrito_producto) {
          carrito_producto.cantidad++;
      } else {
          producto.cantidad = 1;
          this.carrito.push(producto);
      }
  }, 
  calcularTotalCarrito() {
    let total = 0;
    for (const producto of this.carrito) {
        total += producto.precio * producto.cantidad;
    }
    return total;
},
  limpiarCesta(){
    while (this.carrito.length > 0) {
      this.carrito.pop();
    }

  },
  realizarCompra() {
    this.mostrarModalCorreo = true;
  },
  guardarCorreoYContinuar() {
    // Guarda el correo ingresado y realiza la acción necesaria
    this.mostrarModalCorreo = false; // Cierra el modal
    this.paginaActual = 'compraConfirm'; // Muestra la pagina de compra realizada
  },
  eliminarProducto(producto){
    const index = this.carrito.findIndex(item => item.id === producto.id);
  
    if (index !== -1) {
      this.carrito.splice(index, 1);
    }
  }
    }
}).mount('#app');