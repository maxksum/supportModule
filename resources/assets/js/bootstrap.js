window._ = require('lodash');

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

import Echo from "laravel-echo"

var prefix = process.env.MIX_LOCAL == 1 ? 'http' : 'https';
var port = process.env.MIX_SOCKET_PORT ? process.env.MIX_SOCKET_PORT : 8443;

window.Echo = new Echo({
  broadcaster: 'socket.io',
  host: prefix + '://' + window.location.hostname + ':' + port
});
