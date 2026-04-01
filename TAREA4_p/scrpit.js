document.querySelector("form").addEventListener("submit", function(e) {
    const usuario = document.querySelector("input[name='usuario']").value;
    const password = document.querySelector("input[name='password']").value;

    if (usuario === "" || password === "") {
        alert("Todos los campos son obligatorios");
        e.preventDefault();
    }
});
