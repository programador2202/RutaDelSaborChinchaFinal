// Inicializamos el mapa centrado en Perú
var map = L.map('map').setView([-13.4096, -76.1325], 13);

// Capa base OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap'
}).addTo(map);

var markers = [];
var userMarker = null;
var controlRuta = null; // Control de ruta
var destinoActual = null; // Destino seleccionado



// Limpiar marcadores de restaurantes
function limpiarMarcadores() {
    markers.forEach(m => map.removeLayer(m));
    markers = [];
}

// Mostrar restaurantes
function mostrarRestaurantes(lista) {
    limpiarMarcadores();

    lista.forEach(r => {
        if (r.lat && r.lng) {
            let marker = L.marker([r.lat, r.lng]).addTo(map)
                .bindPopup(`
                    <b>${r.negocio}</b><br>
                    ${r.direccion}<br>
                    <small>${r.categoria}</small><br>
                    <button onclick="mostrarRuta(${r.lat}, ${r.lng})" class="chat-btn">Cómo llegar</button>
                `);

            markers.push(marker);
        }
    });

    // Ajustar mapa a los restaurantes visibles
    if (lista.length > 0) {
        var bounds = L.latLngBounds(lista.map(r => [r.lat, r.lng]));
        if (userMarker) bounds.extend(userMarker.getLatLng());
        map.fitBounds(bounds, { padding: [50, 50] });
    }
}

// Cargar restaurantes desde backend
function cargarRestaurantes(cat = '') {
    let url = '/mapa/restaurantes';
    if (cat) url += '?cat=' + encodeURIComponent(cat);

    fetch(url)
        .then(res => res.json())
        .then(data => mostrarRestaurantes(data))
        .catch(err => console.error("Error cargando restaurantes:", err));
}

// Filtrar por categoría
function filtrarTexto(texto) {
    cargarRestaurantes(texto);
}

// Mostrar ruta desde usuario hasta restaurante
function mostrarRuta(destLat, destLng) {
    if (!userMarker) {
        alert("No se pudo obtener tu ubicación.");
        return;
    }

    destinoActual = L.latLng(destLat, destLng);

    // Eliminar ruta anterior
    if (controlRuta) map.removeControl(controlRuta);

    controlRuta = L.Routing.control({
        waypoints: [userMarker.getLatLng(), destinoActual],
        routeWhileDragging: false,
        draggableWaypoints: false,
        addWaypoints: false,
        showAlternatives: false,
        lineOptions: {
            styles: [{ color: 'blue', opacity: 0.7, weight: 5 }]
        },
        router: L.Routing.osrmv1({ serviceUrl: 'https://router.project-osrm.org/route/v1' })
    }).addTo(map);
}


if (navigator.  geolocation) {
    navigator.geolocation.watchPosition(
        function(position) {
            const userLat = position.coords.latitude;
            const userLng = position.coords.longitude;

            // Actualizar marcador rojo
            if (!userMarker) {
                userMarker = L.marker([userLat, userLng], {
                    icon: L.icon({
                        iconUrl: "https://cdn-icons-png.flaticon.com/512/684/684908.png",
                        iconSize: [32, 32]
                    })
                }).addTo(map).bindPopup("<b>Estás aquí</b>").openPopup();
            } else {
                userMarker.setLatLng([userLat, userLng]);
            }

            // Actualizar ruta si hay un destino seleccionado
            if (destinoActual && controlRuta) {
                controlRuta.setWaypoints([userMarker.getLatLng(), destinoActual]);
            }

            // Ajustar mapa si es la primera vez
            if (!map._zoomInitialized) {
                map.setView([userLat, userLng], 15);
                map._zoomInitialized = true;
            }
        },
        function(error) {
            console.warn("Error obteniendo ubicación:", error.message);
            cargarRestaurantes();
        },
        { enableHighAccuracy: true, maximumAge: 0, timeout: 5000 }
    );
} else {
    console.warn("Geolocalización no soportada");
    cargarRestaurantes();
}

// --------------------- CARGA INICIAL ---------------------
document.addEventListener("DOMContentLoaded", function() {
    cargarRestaurantes();
});
