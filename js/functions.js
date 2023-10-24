import { getSabates } from "./communicatonManagar.js";

const { createApp } = Vue

createApp({
    data() {
        return {
            divActivo: 'portada',
            sabates: [],
            carrito: localStorage.getItem("carrito")!=null?JSON.parse(localStorage.getItem("carrito")):[],
            nCompra: 0,
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

        },
        eliminar(zapato) {
            const index = this.carrito.findIndex(element => element.model === zapato.model);
            this.carrito[index].quantitat--;
            if (this.carrito[index].quantitat == 0){
                this.carrito.splice(index,1);
            }
            localStorage.setItem("carrito", JSON.stringify(this.carrito));

        },
        checkout(){
            if (this.carrito.length == 0){
                alert("Carrito vacio");
            }else{
                let total = 0;
                for (let index = 0; index < this.carrito.length; index++) {
                    const element = this.carrito[index];
                    total += element.preu * element.quantitat;

                }
                document.getElementById("total").innerHTML += total+"€";

                document.getElementById("btnCheckout").className = "hidden";
                document.getElementById("lista").className ="hidden";
                document.getElementById("carrito").className ="hidden";
                document.getElementById("checkout").className = "";
                localStorage.clear();
                const response = fetch("http://localhost:8000/api/comanda", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(this.carrito),
                });
                console.log(JSON.stringify(this.carrito))
                console.log(response);
            }
        },
        mostrar(idDiv){
            if (this.divActivo==idDiv) return true;
            else return false;
        },
        cambiar(nuevoDiv){
            this.divActivo=nuevoDiv;
        }

    },
    created() {
       
        
        getSabates().then(sabates => {
            this.sabates = sabates;
            console.log(this.sabates);
            console.log("aa");
        })

    }
}).mount("#app")
