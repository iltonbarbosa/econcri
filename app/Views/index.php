<!-- Banner -->
<style>
	#map { position: absolute; top: 0; bottom: 0; width: 100%; }
</style>
<div id="map"></div>
<style>
	.coordinates {
	background: rgba(0, 0, 0, 0.5);
	color: #fff;
	position: absolute;
	bottom: 40px;
	left: 10px;
	padding: 5px 10px;
	margin: 0;
	font-size: 11px;
	line-height: 18px;
	border-radius: 3px;
	display: none;
	}
</style>
<pre id="coordinates" class="coordinates"></pre>
<script>
// TO MAKE THE MAP APPEAR YOU MUST
// ADD YOUR ACCESS TOKEN FROM
// https://account.mapbox.com
mapboxgl.accessToken = 'pk.eyJ1IjoiaWx0b25iYXJib3NhIiwiYSI6ImNrZ2MzMXcxMDBhZTQycXA0cDdpbGF6cHAifQ.c7nXFqYLwxCWRav414arIg';
var coordinates = document.getElementById('coordinates');
var map = new mapboxgl.Map({
	container: 'map', // container ID
	style: 'mapbox://styles/mapbox/streets-v11', // style URL
	center: [-47.9344819,-15.8075925], // starting position [lng, lat]
	zoom: 12 // starting zoom
});
var canvas = map.getCanvasContainer();

var geojson = {
	'type': 'FeatureCollection',
	'features': [
		{
		'type': 'Feature',
		'geometry': {
		'type': 'Point',
		'coordinates': [-47.9344819,-15.8075925]
		}
	}
	]
};

function onMove(e) {
	var coords = e.lngLat;
	
	// Set a UI indicator for dragging.
	canvas.style.cursor = 'grabbing';
	
	// Update the Point feature in `geojson` coordinates
	// and call setData to the source layer `point` on it.
	geojson.features[0].geometry.coordinates = [coords.lng, coords.lat];
	map.getSource('point').setData(geojson);
}
 
function onUp(e) {
	var coords = e.lngLat;
	
	// Print the coordinates of where the point had
	// finished being dragged to on the map.
	coordinates.style.display = 'block';
	coordinates.innerHTML =
	'Longitude: ' + coords.lng + '<br />Latitude: ' + coords.lat;
	canvas.style.cursor = '';
	
	// Unbind mouse/touch events
	map.off('mousemove', onMove);
	map.off('touchmove', onMove);
}
 
map.on('load', function () {
	// Add a single point to the map
	map.addSource('point', {
		'type': 'geojson',
		'data': geojson
		});
 
	map.addLayer({
		'id': 'point',
		'type': 'circle',
		'source': 'point',
		'paint': {
		'circle-radius': 10,
		'circle-color': '#3887be'
		}
	});
 
// When the cursor enters a feature in the point layer, prepare for dragging.
	map.on('mouseenter', 'point', function () {
		map.setPaintProperty('point', 'circle-color', '#3bb2d0');
		canvas.style.cursor = 'move';
	});
	
	map.on('mouseleave', 'point', function () {
		map.setPaintProperty('point', 'circle-color', '#3887be');
		canvas.style.cursor = '';
	});
	
	map.on('mousedown', 'point', function (e) {
		// Prevent the default map drag behavior.
		e.preventDefault();
		
		canvas.style.cursor = 'grab';
		
		map.on('mousemove', onMove);
		map.once('mouseup', onUp);
	});
	
	map.on('touchstart', 'point', function (e) {
		if (e.points.length !== 1) return;
		
		// Prevent the default map drag behavior.
		e.preventDefault();
		
		map.on('touchmove', onMove);
		map.once('touchend', onUp);
	});
});
</script>