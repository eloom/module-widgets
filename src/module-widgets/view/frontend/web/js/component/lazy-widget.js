define(["jquery"],function(d){return function(l,m){document.querySelectorAll("[data-eloom-widget]").forEach(function(f){(new IntersectionObserver(function(g,h){g.forEach(function(a){try{if(a.isIntersecting&&!a.isVisible){var b=a.target,k=b.getAttribute("data-uri"),e=b.getAttribute("data-params");d.ajax({url:k,type:"POST",data:JSON.parse(e?e:""),showLoader:!1}).done(function(c){d(b).html(c.output).trigger("contentUpdated")}).fail();h.disconnect()}}catch(c){console.error(c)}})})).observe(f)})}});