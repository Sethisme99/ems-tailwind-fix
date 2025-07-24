import Alpine from 'alpinejs'
import Intersect from '@alpinejs/intersect'
import List from 'list.js';


window.Alpine = Alpine
window.List = List;

Alpine.plugin(Intersect)
Alpine.start()