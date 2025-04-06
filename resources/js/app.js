import './bootstrap';
import 'bootstrap';
import 'bootstrap/dist/js/bootstrap.bundle.min';
import { createApp } from 'vue';
import FavoriteIcon from './components/FavoriteIcon.vue';
import SuccessAlert from './components/SuccessAlert.vue';

const app = createApp({});

app.component('success-alert', SuccessAlert);
app.component('favorite-icon', FavoriteIcon);

app.mount('#app');