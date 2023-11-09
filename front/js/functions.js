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
            mostrarMenu: false,
            token: null,
            user: null,
            ticket: {
                carrito : [],
                total : null,
            },
            register: {
                nom: null,
                cognoms: null,
                email: null,
                telefon: null,
                password: null,
                password_confirmation: null,
            },
            aplicarTransicion: false,
            paginaActual: 1,
            sabatesPagina: 4,
        }
    },
    methods: {
        canviaPagina(direccio) {
            if (direccio === -1) {
              if (this.paginaActual > 1) {
                this.paginaActual--;
              }
            } else {
              if (this.paginaActual < this.totalPagina) {
                this.paginaActual++;
              }
            }
        },
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
            this.aplicarTransicion = true;
            setTimeout(() => { this.aplicarTransicion = false; }, 500);
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
            this.aplicarTransicion = true;
            setTimeout(() => { this.aplicarTransicion = false; }, 500);

        },
        btnUsuario() {
            if (this.token == null) {
                this.cambiar('mostrarInicioSesion');
            } else {
                if (document.querySelector(".menuUsuariActiu") == null) {
                    document.querySelector(".menuUsuari").classList.add("menuUsuariActiu");
                } else {
                    document.querySelector(".menuUsuari").classList.remove("menuUsuariActiu");

                }
            }
        },
        async logout() {
            let token = new FormData();
            token.append("token", this.token);
            let response = await fetch("http://127.0.0.1:8000/api/logout", {
                method: "POST",
                headers: {
                    "Authorization": 'Bearer {' + this.token + '}',
                    "Content-Type": "application/json",

                },
                body: token,

            });
            response = await response.json();
            console.log(response);
            this.cambiar("portada");
            this.token = null;
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
        async guardarCorreoYContinuar(nuevoDiv) {
            // Guarda el correo ingresado y realiza la acción necesaria
            let user = null;
            if (this.token == null) {
                user = document.getElementById("emailUser").value;
            } else {
                user = this.user.email;
            }
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
                    fetch("http://127.0.0.1:8000/api/comanda", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify(payload),
                    });
                    this.ticket.carrito = this.carrito;
                    this.ticket.total = this.total;
                    this.limpiarCesta();
                }
            }
        },
        quitarFiltre(){
            this.paginaActual = 1;
            this.mostrarBotiga();
            let buttons = document.querySelectorAll('nav button');
            buttons.forEach(button => {
                button.classList.remove("actiu");
            });
            this.sabatesMostrar = this.sabates;

        },
        mostrarBotiga() {
            this.divActivo = "tienda";
        }, filtre(e, filtrar) {
            this.paginaActual= 1;
            this.mostrarBotiga();
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
            if (this.token == null) {
                this.mostrarModalCorreo = true;
            } else {
                this.guardarCorreoYContinuar('compraConfirm');
            }
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

        },
        async registrar() {

            var formulari = new FormData();
            formulari.append("nom", this.register.nom);
            formulari.append("cognoms", this.register.cognoms);
            formulari.append("email", this.register.email);
            formulari.append("telefon", this.register.telefon);
            formulari.append("password", this.register.password);
            formulari.append("password_confirmation", this.register.password_confirmation);
            console.log(this.register);

            let response = await fetch("http://localhost:8000/api/register", {
                method: "POST",
                headers: {
                    "Access-Control-Allow-Origin": "*",
                },
                body: formulari,
            })
            
            response = await response.json();
            if (response.error == 2) {
                document.getElementById('errorContrasenya').classList.add("hidden");
                document.getElementById('errorEmail').classList.remove("hidden");
            } else if (response.error == 1) {
                document.getElementById('errorContrasenya').classList.remove("hidden");
                document.getElementById('errorEmail').classList.add("hidden");

            } else {

                this.cambiar('mostrarInicioSesion');

            }





        },
        async comandasUsuari(){
            
            let response = await fetch("http://localhost:8000/api/comanda", {
                method: "GET",
                headers: {
                    "Access-Control-Allow-Origin": "*",
                    "Authorization": 'Bearer {' + this.token + '}',
                },
                body: null
            })
            response = await response.json();
            console.log(response);
            
            if (response.error==null) {
                this.comandas = response;
                this.cambiar('comandasUsuari');
            }else{
                this.cambiar('portada');
                this.token = null;
                this.user = null;
                alert('Sessio expirada');
            }
        },
        async login() {

            var formulari = new FormData();

            formulari.append("email", this.register.email);
            formulari.append("password", this.register.password);

            let response = await fetch("http://localhost:8000/api/login", {
                method: "POST",
                headers: {
                    "Access-Control-Allow-Origin": "*",
                },
                body: formulari,
            })
            response = await response.json();

            this.token = response.token;
            this.user = response.user;
            if (this.token == null) {
                document.getElementById("errorLogin").classList.remove("hidden");
            } else {
                this.cambiar("tienda")
            }

        },


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

    },
    computed: {
        paginacioSabates() {
          const iniciIndex = (this.paginaActual - 1) * this.sabatesPagina;
          const finalIndex = iniciIndex + this.sabatesPagina;
          return this.sabatesMostrar.slice(iniciIndex, finalIndex);
        },
        totalPagina() {
          return Math.ceil(this.sabatesMostrar.length / this.sabatesPagina);
        },
      }
}).mount("#app")
