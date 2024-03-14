var URLfiles = [];

function dragOverHandler(event) {
    event.preventDefault();
}

function dropHandler(event) {
    event.preventDefault();

    const files = Array.from(event.dataTransfer.files);

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        if (file.type.startsWith('image/')) {

            const formData = new FormData();
            formData.append('image', file);

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Realizar una solicitud AJAX al backend para guardar la imagen
            const xhr = new XMLHttpRequest();
            xhr.open('POST', uploadImageUrl); // Ajusta la ruta según tu configuración
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    URLfiles.push(response.path);
                    showImages();
                    updatePhotoUrlsInput();
                } else {
                    console.error('Error al guardar la imagen');
                }
            };
            xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
            xhr.send(formData);
        } else {
            files.splice(i, 1);
            i--;
        }
    }
}

function showImages() {
    const imagenesDiv = document.getElementById('imagenes');
    imagenesDiv.innerHTML = ''; // Limpiar el contenido del div antes de mostrar nuevas imágenes

    URLfiles.forEach(function(url) {
        // Ajusta la ruta de la imagen para reflejar la estructura de directorios correcta
        const adjustedUrl = baseImageUrl + url;

        const img = document.createElement('img');
        img.src = adjustedUrl;
        img.style.width = '100px'; // Ajusta el ancho según sea necesario
        img.style.height = '100px'; // Ajusta la altura según sea necesario
        imagenesDiv.appendChild(img);
    });
}

function updatePhotoUrlsInput() {
    const photoUrlsInput = document.getElementById('photo_urls');
    photoUrlsInput.value = JSON.stringify(URLfiles);
}