jQuery(function(e){function t(){e.each(wpsl_locator_mapstyles,function(e,t){o(e,t),s(t)})}function o(t,o){var s="<li";t%3===0&&(s+=' class="first"'),s+=">",s+="<h4>"+o.title+"</h4>",s+='<div class="map" id="map_'+o.id+'"></div>',s+='<a href="'+o.id+'" class="choose-style">',s+="Choose",s+="</a>",s+="</li>",e("#map-styles").append(s)}function s(e){var t=JSON.parse(e.styles),o="map_"+e.id,s={center:new google.maps.LatLng(40.7699354,-73.9810812),zoom:13,mapTypeControl:!1,streetViewControl:!1,styles:t},e=new google.maps.Map(document.getElementById(o),s)}e(document).ready(function(){t()})});