document.addEventListener("DOMContentLoaded", (event) => {
    //Create map
    var map = L.map('map').setView([user_lat, user_long], 13, {
        animate: true,
        duration: 0.5
    });

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);


    var meIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-black.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    var greenIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    var marker = L.marker([user_lat, user_long], {icon: meIcon}).addTo(map);
    marker.bindPopup("Votre position").openPopup();
    var popup = L.popup();
    for(var i = 0; i < annonce_lat.length; i++){
        var marker_prod = L.marker([annonce_lat[i], annonce_long[i]], {icon: greenIcon}).addTo(map);
        marker_prod.bindPopup("<div id='annonceinfo"+i+"'><h2> @"+ annonce_productor[i] +"</h2></div>").closePopup();
        var popup_prod = L.popup();
        get_annonceinfo(i);
        var popup = marker_prod.getPopup();
        var chart_div = document.getElementById("annonce_content"+i);
        popup.setContent( chart_div );
    }

    function get_annonceinfo(i){
        var information = document.getElementById('information');
        var section = document.createElement("section");
        section.setAttribute("id","annonce_content"+i)
        var title = document.createElement("h2");
        title.innerHTML = "@"+ annonce_productor[i];
        section.appendChild(title);
        for(var k = 0; k < annonce_content.length; k++){
            if(annonce_content[k].productor == annonce_productor[i]){
                var div = document.createElement("div");
                div.setAttribute("class","bloc");
                div.innerHTML = annonce_content[k].date;
                for(var j = 0; j < annonce_content[k].products_info.length; j++) {
                    var p_name = document.createElement("p");
                    p_name.innerHTML = annonce_content[k].products_info[j].name_product;
                    p_name.setAttribute("class","info_display");
                    div.appendChild(p_name);
                    var p_conserv = document.createElement("p");
                    p_conserv.innerHTML = "date de préremption : "+ annonce_content[k].products_info[j].conserv;
                    p_conserv.setAttribute("class","info_display");
                    div.appendChild(p_conserv);
                    var p_qte = document.createElement("p");
                    p_qte.innerHTML = "Unité : "+ annonce_content[k].products_info[j].quantity;
                    p_qte.setAttribute("class","info_display");
                    div.appendChild(p_qte);
                }
                div.innerHTML +=`<form method='get' action='announcement_page.php'>
                    <button class="Add maps" name='id_announcement' value='"`+ annonce_content[k].id_notice +`"'>Voir l'offre</button>
                </form>
                `;
                section.appendChild(div);
            }
        }
        information.appendChild(section);
    }
});



