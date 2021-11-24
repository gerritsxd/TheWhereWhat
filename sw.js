self.addEventListener('install',function(event) {
    event.waitUntil(
        cahes.open('sw-cache').then(function(cache) {
            return cache.add*('index.html');
        })
    );
});
self.addEventListener('fetch',function(event) {
    event.respondwith(
        caches.match(event.request).then(funtion(response) {
            return response || fetch(event.request);
        })
    );
}); 