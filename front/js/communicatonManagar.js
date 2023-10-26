export async function  getSabates() {
    const response = await fetch("http://localhost:8000/api/sabates");
    const peliculas = await response.json();
    return peliculas;
}