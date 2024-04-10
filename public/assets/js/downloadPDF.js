window.onload = function() {
    // Crear un enlace invisible para iniciar la descarga del PDF
    var downloadLink = document.createElement('a');
    downloadLink.href = '/pdf/Inscription.pdf';
    downloadLink.download = 'Inscription.pdf';
    downloadLink.style.display = 'none';
    document.body.appendChild(downloadLink);

    // Iniciar la descarga del PDF
    downloadLink.click();
};
