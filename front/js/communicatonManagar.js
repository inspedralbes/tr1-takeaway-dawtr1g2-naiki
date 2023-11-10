export async function  getSabates() {
     //Link per el fetch, si estas a labs es canvia la variable linkFetch a .. si es en local es canvia athis.fetchLink+ 
    let fetchLink = "http://localhost:8000";
    const response = await fetch(fetchLink+"/api/sabates");
    const peliculas = await response.json();
    return peliculas;
}