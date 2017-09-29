From an Internet Search:

Cache in Drupal 8
By default, Drupal 8 enables two modules: Internal Page Cache and Internal Dynamic Page Cache.
Internal Page Cache caches pages for anonymous users. Internal Dynamic Page Cache caches contents
of the page except the personalized pieces, so they can be used for the anonymous and authorized
users. Each object of the page contains metadata, and this piece of metadata tells the Internal
Dynamic Page Cache module if it has to cache the page or not. You can change default metadata
by Cache API.