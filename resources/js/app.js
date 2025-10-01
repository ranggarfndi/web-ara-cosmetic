import './bootstrap';

import Alpine from 'alpinejs';
import mask from '@alpinejs/mask'; // <-- 1. TAMBAHKAN INI

window.Alpine = Alpine;
Alpine.plugin(mask); // <-- 2. TAMBAHKAN INI
Alpine.start();
