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
	zoom: 11.9 // starting zoom
});
var canvas = map.getCanvasContainer();

var geojson = {
	'type': 'FeatureCollection',
	'features': [
		<?php if(isset($coordenadas))
			foreach($coordenadas as $cord):?>
			{
				'type': 'Feature',
				'properties': {
					'idcadastro': '<?=$cord['idcadastro']?>',
					'idcategoria': '<?=$cord['idcategoria']?>',
					'nome': '<?=$cord['nome']?>',
					'nome_contato': '<?=$cord['nome_contato']?>',
					'email_contato': '<?=$cord['email_contato']?>',
					},
				'geometry': {
					'type': 'Point',
					'coordinates': [<?=$cord['longitude']?>,<?=$cord['latitude']?>]
					}
			},
			<?php endforeach?>
		]
};

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
			'circle-radius': 6,
			'circle-color': 'red'
			}
	});

// When the cursor enters a feature in the point layer, prepare for dragging.
	map.on('click', function(e) {
		var features = map.queryRenderedFeatures(e.point, {
			layers: ['point'] // replace this with the name of the layer
		});

		if (!features.length) {
			return;
		}

		var feature = features[0];

		var popup = new mapboxgl.Popup({ offset: [0, -15] })
			.setLngLat(feature.geometry.coordinates)
			.setHTML('<h5> <a href="/Cadastro/visualiza/' + feature.properties.idcadastro + '/' + feature.properties.idcategoria +'">' + feature.properties.nome + '</a></h5><p>Contato: ' + feature.properties.nome_contato + '<br/>E-mail: '+feature.properties.email_contato+'</p>')
			.addTo(map);
	});

	map.on('mouseenter', 'point', function () {
		map.setPaintProperty('point', 'circle-color', 'red');
		canvas.style.cursor = 'pointer';
	});
});
</script>
