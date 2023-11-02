import { getSabates } from "./communicatonManagar.js";

const { createApp } = Vue

createApp({
    data() {
        return {
            divActivo: 'portada',
            mostrarModalLogin: false,
            mostrarModalCorreo: false,
            sabates: [],
            carrito: localStorage.getItem("carrito") != null ? JSON.parse(localStorage.getItem("carrito")) : [],
            nCompra: 0,
            total: 0,
            nItems: 0,
            sabatesMostrar: [],
            mostrarMenu: false
        }
    },
    methods: {
        afegir(zapato) {
            const index = this.carrito.findIndex(element => element.model === zapato.model);

            if (index == -1) {
                zapato.quantitat = 1;
                zapato.talla = 38;

                zapato.created_at = "NOW()"
                zapato.updated_at = "NOW()"
                this.carrito.push(zapato);
            } else {
                this.carrito[index].quantitat++;
            }
            localStorage.setItem("carrito", JSON.stringify(this.carrito));
            this.total += zapato.preu;
            this.nItems++;
        },
        eliminar(zapato) {
            const index = this.carrito.findIndex(element => element.model === zapato.model);
            this.carrito[index].quantitat--;
            if (this.carrito[index].quantitat == 0) {
                this.carrito.splice(index, 1);
            }
            localStorage.setItem("carrito", JSON.stringify(this.carrito));
            this.total -= zapato.preu;
            this.nItems--;


        },
        checkout() {
            if (this.carrito.length == 0) {
                alert("Carrito vacio");
            } else {


                document.getElementById("btnCheckout").className = "hidden";
                document.getElementById("lista").className = "hidden";
                document.getElementById("carrito").className = "hidden";
                document.getElementById("checkout").className = "";
            }
        },
        mostrar(idDiv) {
            if (this.divActivo == idDiv) return true;
            else return false;
        },
        cambiar(nuevoDiv) {
            this.divActivo = nuevoDiv;
        },
        tencarCheckout() {
            this.mostrarModalCorreo = false; // Cierra el modal
        },
        guardarCorreoYContinuar(nuevoDiv) {
            // Guarda el correo ingresado y realiza la acción necesaria

            let user = document.getElementById("emailUser").value;
            console.log(user);
            const validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            if (!user.match(validRegex)) {
                document.querySelector(".checkout__modal>.modal-contenido h3").className = "error";
            } else {
                this.mostrarModalCorreo = false; // Cierra el modal
                this.divActivo = nuevoDiv; // Muestra la pagina de compra realizada
                if (user != null) {
                    let payload = [{ email: user }, { sabates: this.carrito }];
                    localStorage.clear();
                    const response = fetch("http://localhost:8000/api/comanda", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify(payload),
                    });
                    console.log(JSON.stringify(payload))
                    console.log(response);
                    localStorage.clear();
                    this.carrito = [];
                    this.nItems = 0;
                    this.total = 0;
                }
            }
        },
        mostrarBotiga() {
            this.divActivo = "tienda";
        }, filtre(e, filtrar) {
            let buttons = document.querySelectorAll('nav button');
            buttons.forEach(button => {
                button.classList.remove("actiu");
            });
            e.target.classList.add("actiu");
            this.sabatesMostrar = [];
            this.sabates.forEach(sabata => {
                if (sabata.genere == filtrar) {
                    this.sabatesMostrar.push(sabata);
                    console.log(sabata)
                }
            });
            console.log(this.sabatesMostrar);
        },
        completar() {
            this.mostrarModalCorreo = true;

        },
        limpiarCesta() {
            this.carrito = [];
            this.nItems = 0;
            this.total = 0;
            localStorage.clear();
        },

        cesta() {
            let closeShopping = document.querySelector('.closeShopping');

            document.querySelector(".cesta").classList.add("cesta-active");

            closeShopping.addEventListener('click', () => {
                document.querySelector(".cesta").classList.remove("cesta-active");

            })

        }

    },
    created() {


        getSabates().then(sabates => {
            this.sabates = sabates;
            this.sabatesMostrar = sabates;

            console.log(this.sabates);
        })

        for (let index = 0; index < this.carrito.length; index++) {
            const element = this.carrito[index];
            this.total += element.preu * element.quantitat;
            this.nItems += element.quantitat;
        }

    }
}).mount("#app")
