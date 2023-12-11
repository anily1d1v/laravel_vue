import './bootstrap';
import { createApp } from 'vue';
import axios from "axios";



const app = createApp({});
app.config.globalProperties.$axios = axios; // Add Axios to Vue's global properties

import ExampleComponent from './components/ExampleComponent.vue';
import TodoComponent from './components/Todo.vue'; 



app.component('example-component', ExampleComponent);
app.component('todo-component', TodoComponent);

app.mount('#app');
