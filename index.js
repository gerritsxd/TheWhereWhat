// The location of Uluru
const uluru = { lat: 52.364061, lng: 4.882769 };
// The map, centered at Uluru
const map = new google.maps.Map(document.getElementById("map"), {
  zoom: 4,
  center: uluru,
});