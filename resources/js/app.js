import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
 
let table = new DataTable('#despesas', {
    responsive: true
});


