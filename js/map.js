/*
Script for displaying a map with gps coordinates.
This script uses leaflet (leafletjs.com)

Author: Mathias Beke
*/

function createMap(id, lat, long) {
	
	// set up the map
	map = new L.Map(id);
	
	// create the tile layer with correct attribution
	var osmUrl='http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
	var osmAttrib='Map data © OpenStreetMap contributors';
	
	var osm = new L.TileLayer(osmUrl, {
		minZoom: 8,
		maxZoom: 18,
		attribution: osmAttrib
	}
	);		
	
	// start the map in South-East England
	map.setView(new L.LatLng(lat, long),9);
	map.addLayer(osm);
	
	var marker = L.marker([lat, long]).addTo(map);
	
}


function destroyMap(id) {
	document.getElementById(id).className = ""; //Remove the leaflet classes from the container
	window.map.remove();
}
