require('./bootstrap');

import ClipboardJS from 'clipboard';

import 'flatpickr/dist/flatpickr.min.css';

$("#expired_at").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i",
    minDate: "today",
});

new ClipboardJS('#copy_button');
