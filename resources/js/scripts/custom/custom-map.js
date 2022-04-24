/**
 * ========================================================================
 *  CUSTOM MAP
 *  Utiliza leaflet con los tiles de openstreetmap
 *  ========================================================================
 *  ¿Que tenemos que tener en cuenta?
 *  Cuando un método recibe como parámetro a ruta, singnifica un array de:
 *  [Latitud, longitud, zoom, imagen(opcional)]
 */

mymap = null;
function initMap(idMap, lat, long, zoom, openPopUp){
    //https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}.png
    //https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png

    let tilesProvider = 'https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}.png';
    mymap = L.map('mapa');

    mymap.setView([lat,long], zoom);

    L.tileLayer(tilesProvider, {
        maxZoom: 18,
    }).addTo(mymap);

    mapInvalidateSize();

    if(openPopUp){
        mymap.on('zoomend', function (event) {
            console.log(event);
            marcasActivas.forEach(function (e){
                if(e._latlng.lat === event.target._lastCenter.lat && e._latlng.lng === event.target._lastCenter.lng){
                    e.openPopup();
                }
            });
        });


    }
}

// Volamos hacia el sitio, con una animación
// NOTA: Puede provocar que los tiles se queden en gris si existe mala conexión ya que tarda en cargar
function goToCoords(ruta){
    if(mymap !== null){
        mymap.closePopup();
        mymap.flyTo([ruta[0], ruta[1]], ruta[2]);
        setInfo(ruta);
    }
}

// Vamos hacia el sitio sin animaciones, de forma directa
function setView(ruta){
    if(mymap !== null){
        mymap.setView([ruta[0], ruta[1]], ruta[2], {
            reset: true
        });
        setInfo();
    }
}

// Establece un background a un div
isFirst = false;
function setInfo(ruta){
    if(isFirst){
        $('.slide-info').addClass('full-opacity').addClass('transition-opacity');
    }else{
        $(".mapSwiper video").currentTime = 0;
        $('.mapSwiper video').trigger('play');
        isFirst = true;
    }

    // Quitamos el div de la info si estuviera
    setTimeout(function(){
        $('.slide-info').removeClass('full-opacity').removeClass('transition-opacity').fadeOut(1000);
    }, 750);

    // Mostramos el video
    setTimeout(function(){
        // Le damos play al video
        $(".mapSwiper video").currentTime = 0;
        $('.mapSwiper video').trigger('play');
        mapSwiper.slideTo(1, 1000, true);
    }, 250);


    // Esperamos 4 segundos y mostramos la info
    setTimeout(function(){
        //mapSwiper.slideTo(2, 1000, true);
        // Seteamos la info
        $('.port-title').text(ruta[4]);
        $('.port-agent-1').text(ruta[5]);
        $('.port-agent-2').text(ruta[6]);
        $('.port-agent-3').text(ruta[7]);
        $('.slide-info').removeClass('full-opacity').fadeIn(1000);
    }, 3500);

}

/**
 *  Seteamos las marcas en el mapa y las añadimos todos los eventos añadiendo un id
 *  por si necesitamos ejecutar programáticamente su popup
 */
marcasActivas = [];
function setMarks(marcas){
    marcas.forEach(function (e, i){
        const titulo = e[4] === undefined ? '' : e[4];
        const url = e[5] === undefined ? '' : e[5];
        marcasActivas.push(L.marker([e[0], e[1]], {id: i}).addTo(mymap).bindPopup(`<b>${titulo}</b>`));
    });
}

// Cuando la página ha cargado completamente reiniciamos
// el size del mapa para que no haya errores en los tiles (grises)
function mapInvalidateSize(){
    setTimeout(() => {
        mymap.invalidateSize();
    }, 1000);
}
