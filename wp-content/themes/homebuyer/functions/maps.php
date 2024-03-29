<?php

//
// HUB MAP
//

function homebuyer_map_shortcode($atts = [], $content = null) {
    if (!isset($atts['query'])) {
        return 'Error: The "query" parameter is required.';
    } else if (!isset($atts['type'])) {
        return 'Error: The "type" parameter is required.';
    } else if (!in_array($atts['type'], ['city', 'zipcode'])) {
        return 'Error: The "type" parameter must be one of "city", "zipcode".';
    }

    return '
	<div>
        <div class="hub-map" id="' . $atts['query'] . '"></div>
        <script>
            (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
                key: "AIzaSyALXddRh9W1cKulloc4OGdlhgiEoU9cr1k",
                v: "beta",
            });
        </script>
        <script>
            (async function(query, type) {
                let map;
                let featureLayer;
                let center;
                const includedType = type === "city" ? "locality" : "postal_code";
                const featureType = includedType.toUpperCase();

                async function findBoundary(Place) {
                    const request = {
                        query,
                        fields: ["id", "location"],
                        includedType,
                        locationBias: center,
                    };
                    const { places } = await Place.searchByText(request);

                    if (places.length) {
                        const place = places[0];

                        styleBoundary(place.id);
                        map.setZoom(10);
                        map.panTo(place.location);
                    } else {
                        console.log("No results");
                    }
                }

                function styleBoundary(placeid) {
                    // Define a style of transparent purple with opaque stroke.
                    const styleFill = /** @type {!google.maps.FeatureStyleOptions} */ ({
                        // strokeColor: "#009BFF",
                        // strokeOpacity: 1.0,
                        // strokeWeight: 3.0,
                        // fillColor: "#009BFF",
                        // fillOpacity: 0.2,
                        strokeColor: "#5462d1",
                        strokeOpacity: 0.7,
                        strokeWeight: 3.0,
                        fillColor: "#5462d1",
                        fillOpacity: 0.5,
                    });

                    // Define the feature style function.
                    featureLayer.style = (params) => {
                        if (params.feature.placeId == placeid) {
                            return styleFill;
                        }
                    };
                }

                const { Map } = await google.maps.importLibrary("maps");
                const { Place } = await google.maps.importLibrary("places");

                map = new Map(document.getElementById(query), {
                    // zoom: 9,
                    // center: { lat: 39.103119, lng: -84.512016 },
                    zoom: 4,
                    center: { lat: 38.698448, lng: -96.656159 },
                    streetViewControl: false,
                    mapId: "424f3cce95accc95",
                });
                featureLayer = map.getFeatureLayer(featureType);
                findBoundary(Place);
            })("' . $atts['query'] . '", "' . $atts['type'] . '");
        </script>
    </div>
    ';
}
add_shortcode( 'homebuyer_map', 'homebuyer_map_shortcode' );

