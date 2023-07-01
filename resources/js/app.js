require('./bootstrap');
require('./helper')

import { createApp } from 'vue';
import AppComponent from './components/App'

import { router } from './router';

const app = createApp(AppComponent);

app.use(router)

app.mount('#app')