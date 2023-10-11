/* -----------------------------------------
* MAP VIEWER
-------------------------------------------*/
import tt from "@tomtom-international/web-sdk-maps"

// INIT
const mapButton = document.getElementById('map-button');
const mapContainer = document.getElementById('map');

// Add Listener
mapButton.addEventListener('click', () => {

    if (mapContainer) {

        const lat = mapContainer.dataset.latitude;
        const lon = mapContainer.dataset.longitude;

        const map = tt.map({
            key: import.meta.env.VITE_TT_API_KEY,
            container: mapContainer,
            center: [
                lon,
                lat
            ],
            zoom: 12
        });
        map.addControl(new tt.NavigationControl());

        const marker = new tt.Marker().setLngLat([lon, lat]).addTo(map);

        // Fix map size bug
        setTimeout(() => { map.resize(); }, 200);

    }
})