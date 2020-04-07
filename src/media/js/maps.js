var map;
map = new mapboxgl.Map({
	container: map_container_name,
	style: "mapbox://styles/mapbox/streets-v11",
	center: [map_center_longitude, map_center_latitude],
	zoom: 14,

}),

map.on("load", function () {
	map.addSource('polygon', {
		type: 'geojson',
		data: polygon_data_url
	});
	map.addLayer({
		'id': 'polygon',
		'type': 'fill',
		'source': 'polygon',
		'layout': {},
		'paint': {'fill-color': '#088',  'fill-opacity': 0.8}
		});
})
