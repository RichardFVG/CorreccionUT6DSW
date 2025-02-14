// public/js/app.js

// 1. Espero a que el contenido del DOM 
// esté cargado
document.addEventListener("DOMContentLoaded", function () {

    // 2. Obtengo el formulario de login 
    // y la zona de mensaje
    const loginForm = 
    document.getElementById("loginForm");
    
    const mensajeResultado = 
    document.getElementById("mensajeResultado");

    // 3. Verifico si existe el formulario 
    // en la página
    if (loginForm) {
        // 4. Añado un evento de submit al 
        // formulario
        loginForm.addEventListener("submit", function (event) {
            // 5. Previeno el envío tradicional 
            // del formulario
            event.preventDefault();

            // 6. Obtengo los valores 
            // ingresados por el usuario
            const formData = new FormData(loginForm);
            const usuario = formData.get("usuario");
            const password = formData.get("password");

            // 7. Valido mínimamente en el 
            // front que no estén vacíos
            if (!usuario || !password) {
                mensajeResultado.textContent = 
                "Debes ingresar usuario y contraseña.";

                mensajeResultado.style.color = 
                "red";

                return;
            }

            // 8. Realizo la petición POST 
            // usando Axios
            axios.post(
                "../../public/index.php?controller=Login&action=login", 
                formData
            )
                .then(response => {
                    const data = response.data;
                    // 9. Si ok = true, todo ha ido bien
                    if (data.ok) {
                        mensajeResultado.style.color = "green";
                        mensajeResultado.textContent = data.msg;

                        // 10. Redirijo a la URL 
                        // si se indicó en la respuesta
                        if (data.redirectUrl) {
                            window.location.href = data.redirectUrl;
                        }
                    } 
                    
                    else {
                        // 11. Si hay error, muestro 
                        // el mensaje en rojo
                        mensajeResultado.style.color = "red";
                        mensajeResultado.textContent = data.msg;

                        // 12. Si viene un debugOutput, lo 
                        // muestro en una nueva ventana
                        if (data.debugOutput) {
                            const debugVentana = 
                            window.open(
                                "", "debugOutput", "width=600,height=400"
                            );
                            debugVentana.document.write(
                                "<pre>" + data.debugOutput + "</pre>"
                            );
                            debugVentana.document.title = 
                            "(AXIOS, no Xajax) Debug Output";
                        }
                    }
                })

                .catch(error => {
                    // 13. En caso de error de conexión, lo 
                    // muestro en consola y en mensaje
                    console.error("Error en la petición Axios:", error);
                    mensajeResultado.style.color = 
                    "red";
                    mensajeResultado.textContent = 
                    "Ha ocurrido un error de conexión.";
                });
        });
    }
});
