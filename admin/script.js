// Initialize map, set view to Kathmandu
var map = L.map('map').setView([27.7172, 85.3240], 13);

// Add OpenStreetMap tile layer
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '© OpenStreetMap'
}).addTo(map);

var markers = [];
var pickupLocationsInput = document.getElementById('pickupLocations'); // Hidden input for submission
var pickupList = document.getElementById('pickupList'); // Display lat/lng below the map

// Function to format lat/long into the desired string
function formatPickupLocations() {
    return markers.map(marker => {
        var loc = marker.getLatLng();
        return `${loc.lat}zzz${loc.lng}`;
    }).join('xxx');
}

// Function to update hidden field and display pickup locations
function updatePickupLocations() {
    var locations = markers.map(marker => marker.getLatLng());

    // Update hidden input field for form submission with formatted string
    pickupLocationsInput.value = formatPickupLocations();

    // Display latitudes and longitudes below the map
    pickupList.innerHTML = locations.map((loc, index) => 
        `<p>Pickup Location ${index + 1}: Latitude: ${loc.lat.toFixed(6)}, Longitude: ${loc.lng.toFixed(6)}</p>`
    ).join('');
}

// Add marker on map click, remove if marker exists at the location
map.on('click', function (e) {
    var existingMarker = markers.find(m => m.getLatLng().equals(e.latlng));

    if (existingMarker) {
        map.removeLayer(existingMarker);
        markers = markers.filter(m => m !== existingMarker);
    } else {
        var marker = L.marker(e.latlng).addTo(map);
        markers.push(marker);

        // Add event listener to remove marker on click
        marker.on('click', function () {
            map.removeLayer(marker);
            markers = markers.filter(m => m !== marker);
            updatePickupLocations();
        });
    }
    updatePickupLocations();
});