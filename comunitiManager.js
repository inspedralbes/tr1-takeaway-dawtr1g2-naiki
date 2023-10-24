export async function  getJson() {
    const response = await fetch("./almacen.json");
    const peliculas = await response.json();
    return peliculas;
}