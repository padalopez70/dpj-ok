import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

//laravel-simple-select
import { createPopper } from "@popperjs/core";
window.createPopper = createPopper;

//flatpickr
import flatpickr from 'flatpickr';
import Spanish  from 'flatpickr/dist/l10n/es.js';
window.flatpickr = flatpickr;
window.flatpickr.localize(Spanish);
flatpickr('#loaned');
//livewire
//window.Livewire = Livewire;
