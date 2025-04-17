
// Importar Bootstrap
// import 'bootstrap';
// import 'bootstrap/dist/css/bootstrap.min.css';

// Importar o Axios
import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
