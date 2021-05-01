<!-- Banner -->
<style>
	#map { position: absolute; top: 70px; bottom: 0; width: 100%; }
</style>
<div id="map"></div>
<style>
	.coordinates {
	background: rgba(0, 0, 0, 0.5);
	color: #fff;
	position: absolute;
	bottom: 60px;
	left: 10px;
	padding: 5px 10px;
	margin: 0;
	font-size: 11px;
	line-height: 18px;
	border-radius: 3px;
	display: none;
	}
</style>
<?php
	if(!isset($latitude) && !isset($longitude)){
		$longitude = -47.9344819;
		$latitude =  -15.8075925;
	}

?>

<form action="<?= base_url('controle/cadastro/gravarCordenadas') ?>" method="post" id="coordinates" class="coordinates" >
	<label>Longitute: </label>
	<input type='text' name='longitude' id="longitude" value="222222" /><br />
	<label>Latitude: </label>
	<input type='text' name='latitude' id="latitude" value="22222" /><br />
	<?= csrf_field(); ?>
	<input style='margin-left:6em' type='submit' name='submit' class='btn btn-avanca btn-primary' value='Confirma'/>";
</form>	

<script>
// TO MAKE THE MAP APPEAR YOU MUST
// ADD YOUR ACCESS TOKEN FROM
// https://account.mapbox.com
mapboxgl.accessToken = 'pk.eyJ1IjoiaWx0b25iYXJib3NhIiwiYSI6ImNrZ2MzMXcxMDBhZTQycXA0cDdpbGF6cHAifQ.c7nXFqYLwxCWRav414arIg';
var coordinates = document.getElementById('coordinates');
var map = new mapboxgl.Map({
	container: 'map', // container ID
	style: 'mapbox://styles/mapbox/streets-v11', // style URL
	center: [<?=$longitude?>,<?=$latitude?>], // starting position [lng, lat]
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
		'coordinates': [<?=$longitude?>,<?=$latitude?>]
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
	latitude.value = coords.lat;
	longitude.value = coords.lng;
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
		'circle-color': 'red'
		}
	});
 
// When the cursor enters a feature in the point layer, prepare for dragging.
	map.on('mouseenter', 'point', function () {
		map.setPaintProperty('point', 'circle-color', 'red');
		canvas.style.cursor = 'move';
	});
	
	map.on('mouseleave', 'point', function () {
		map.setPaintProperty('point', 'circle-color', 'red');
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
