import { createApp } from "vue";
import App from "./App.vue";

// Import Vue Router
import router from "./router";

// Import Bootstrap 5
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js";

const app = createApp(App);

// Gunakan Vue Router
app.use(router);

app.mount("#app");
