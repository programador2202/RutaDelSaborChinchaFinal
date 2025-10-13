// Inicializamos el mapa centrado en Perú
var map = L.map('map').setView([-13.4096, -76.1325], 13);

// Capa base OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap'
}).addTo(map);

var markers = [];
var userMarker = null;
var controlRuta = null;
var destinoActual = null;

// Limpiar marcadores
function limpiarMarcadores() {
    markers.forEach(m => map.removeLayer(m));
    markers = [];
}

// Mostrar restaurantes en el mapa
function mostrarRestaurantes(lista) {
    limpiarMarcadores();

    lista.forEach(r => {
        const lat = parseFloat(r.lat);
        const lng = parseFloat(r.lng);

        if (!isNaN(lat) && !isNaN(lng)) {
            let marker = L.marker([lat, lng]).addTo(map)
                .bindPopup(`
                    <b>${r.negocio}</b><br>
                    ${r.direccion || ''}<br>
                    ${r.plato ? `<small>${r.plato}</small>` : ''}<br>
                    <button onclick="mostrarRuta(${lat}, ${lng})" class="chat-btn">Cómo llegar</button>
                `);
            markers.push(marker);
        }
    });

    // Ajustar mapa a los restaurantes visibles
    if (markers.length > 0) {
        var bounds = L.latLngBounds(markers.map(m => m.getLatLng()));
        if (userMarker) bounds.extend(userMarker.getLatLng());
        map.fitBounds(bounds, { padding: [50, 50] });
    }
}

// Cargar restaurantes por categoría
function cargarRestaurantes(cat = '') {
    let url = '/mapa/restaurantes';
    if (cat) url += '?cat=' + encodeURIComponent(cat);

    fetch(url)
        .then(res => res.json())
        .then(data => mostrarRestaurantes(data))
        .catch(err => console.error("Error cargando restaurantes:", err));
}

// Cargar restaurantes según plato buscado
window.cargarRestaurantesPorPlato = function(plato = '') {
    // Construir la URL correctamente con base_url de CodeIgniter
   let url = "<?= base_url('/buscar/mapaBusquedaPorPlato') ?>";
    if (plato) {
        url += '?q=' + encodeURIComponent(plato);
    } else {
        // Si no hay plato, opcionalmente podemos limpiar los marcadores
        limpiarMarcadores();
        return;
    }

    fetch(url)
        .then(res => {
            if (!res.ok) throw new Error("Error en la respuesta del servidor");
            return res.json();
        })
        .then(data => {
            // Mostrar en el mapa
            mostrarRestaurantes(data);
        })
        .catch(err => console.error("Error cargando restaurantes por plato:", err));
};


// Mostrar ruta desde usuario hasta restaurante
function mostrarRuta(destLat, destLng) {
    if (!userMarker) {
        alert("No se pudo obtener tu ubicación.");
        return;
    }

    destinoActual = L.latLng(destLat, destLng);

    if (controlRuta) map.removeControl(controlRuta);

    controlRuta = L.Routing.control({
        waypoints: [userMarker.getLatLng(), destinoActual],
        routeWhileDragging: false,
        draggableWaypoints: false,
        addWaypoints: false,
        showAlternatives: false,
        lineOptions: { styles: [{ color: 'blue', opacity: 0.7, weight: 5 }] },
        router: L.Routing.osrmv1({ serviceUrl: 'https://router.project-osrm.org/route/v1' })
    }).addTo(map);
}

// Geolocalización del usuario
if (navigator.geolocation) {
    navigator.geolocation.watchPosition(
        function(position) {
            const userLat = position.coords.latitude;
            const userLng = position.coords.longitude;

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

            if (destinoActual && controlRuta) {
                controlRuta.setWaypoints([userMarker.getLatLng(), destinoActual]);
            }

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

// Carga inicial del mapa
document.addEventListener("DOMContentLoaded", function() {
    cargarRestaurantes();
});

// Filtrar por categoría
function filtrarTexto(texto) {
    cargarRestaurantes(texto);
}