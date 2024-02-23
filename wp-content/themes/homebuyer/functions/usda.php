<?php

//
// USDA Eligibility
//

function usda_shortcode() {
    $hostname = parse_url(get_site_url(), PHP_URL_HOST);
    $target = 'https://app.homebuyer.com';

    if (preg_match("/local/i", $hostname)) {
        $target = 'http://localhost:3000';
    } else if (preg_match("/stage/i", $hostname)) {
        $target = 'https://app-staging.homebuyer.com';
    }

    parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $params);
    $location = $params['location'];

    return '
    <div>
        <input id="usda-address" placeholder="Enter Property Address" type="text" autocomplete="off" value="' . $location . '">
        <div id="usda-map"></div>
        <figcaption><em>Source: U.S. Department of Agriculture. Last Verified: ' . date('F j, Y') . '</em></figcaption>
        <script>
            (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
                key: "AIzaSyBd5pVhrnRgAKK6gn-XxVEBX8NlqXEHOpo",
                v: "beta",
            });
        </script>
        <script>
            (async function() {
                let autocomplete;
                let map;
                let place;
                let pin;
                let marker;
                let info;
                async function lookupAddress() {
                    const place = autocomplete.getPlace();
                    if (!place.geometry) return;

                    document.getElementById("usda-address").classList.add("disabled");
                    if (marker) marker.setMap(null);

                    const lat = place.geometry.location.lat();
                    const lng = place.geometry.location.lng();
                    const address = place.formatted_address;
                    // console.log({ place });

                    const params = new URLSearchParams({ lat, lng, address });
                    const response = await fetch("https://api.homebuyer.com/v1/geo/urban?" + params);
                    const result = await response.json();
                    window.dataLayer = window.dataLayer || [];
                    dataLayer.push({
                      event: "USDA Map: Address Lookup Performed",
                      eventLabel: address,
                    });
                    dataLayer.push({
                      event: `USDA Map: Address ${result ? "Ineligible" : "Eligible"}`,
                      eventLabel: address,
                    });

                    let content;
                    if (result) {
                        content = `<div class="usda-info-window"><p><span class="ineligible">Not eligible for USDA home loan</span><br>${address}</p></div>`;
                    } else {
                        content = `<div class="usda-info-window"><p><span class="eligible">ELIGIBLE for USDA home loan</span><br>${address}</p><p><a data-category="Pre-approval" data-action="Click" data-label="article-usda-map" href="' . $target . '">Get pre-approved</a></p></div>`;
                    }

                    info = new google.maps.InfoWindow({ content });
                    marker = new google.maps.Marker({
                        position: place.geometry.location,
                        map,
                        animation: google.maps.Animation.DROP,
                        icon: pin,
                    });
                    marker.addListener("click", () => {
                        info.open({ anchor: marker, map });
                    });
                    map.setZoom(11);
                    map.panTo(place.geometry.location);
                    setTimeout(() => info.open({ anchor: marker, map }), 1000);

                    document.getElementById("usda-address").classList.remove("disabled");
                    document.getElementById("usda-address").classList.add(result ? "ineligible" : "eligible");
                }
                let opts = {
                    zoom: 4,
                    center: {
                      lat: 38.698448,
                      lng: -96.656159,
                    },
                };
                const params = new URLSearchParams(window.location.search);
                if (params.get("lat") && params.get("lng")) {
                  opts = {
                    zoom: 9,
                    center: {
                      lat: parseFloat(params.get("lat")),
                      lng: parseFloat(params.get("lng")),
                    },
                  };
                }
                const { Map } = await google.maps.importLibrary("maps");
                const { Autocomplete } = await google.maps.importLibrary("places");
                map = new Map(document.getElementById("usda-map"), {
                    // zoom: 9,
                    // center: { lat: 39.103119, lng: -84.512016 },
                    ...opts,
                    streetViewControl: false,
                    mapId: "a6335252eb79d950",
                });
                const datasetLayer = map.getDatasetFeatureLayer("dd7ed56f-fc64-4ff3-ba88-179da12ff82d");
                datasetLayer.style = {
                  strokeColor: "#5462d1",
                  strokeOpacity: 0.7,
                  strokeWeight: 3.0,
                  fillColor: "#5462d1",
                  fillOpacity: 0.5,
                };
                autocomplete = new Autocomplete(document.getElementById("usda-address"), {
                    fields: ["formatted_address", "geometry"],
                    types: ["address"],
                    componentRestrictions: { country: "us" },
                });
                autocomplete.addListener("place_changed", lookupAddress);
                document.getElementById("usda-address").addEventListener("focus", () => {
                    document.getElementById("usda-address").classList.remove("eligible", "ineligible");
                    if (info) info.close();
                });
                pin = {
                    url: "/wp-content/themes/homebuyer/images/pin.png",
                    scaledSize: new google.maps.Size(50, 50),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(25, 50)
                };
            })();
        </script>
    </div>
    ';
}
add_shortcode( 'show_usda', 'usda_shortcode' );

