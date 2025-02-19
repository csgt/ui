/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import "./bootstrap";
import { createApp } from "vue";

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import CatalogsRolesEdit from "../../vendor/csgt/utils/src/resources/views/catalogs/RolesEdit.vue";
import CatalogsRoleModule from "../../vendor/csgt/utils/src/resources/views/catalogs/RoleModule.vue";
import CatalogsUsersEdit from "../../vendor/csgt/utils/src/resources/views/catalogs/UsersEdit.vue";
import Profile from "../../vendor/csgt/utils/src/resources/views/Profile.vue";

const app = createApp();

app.component("catalogs-roles-edit", CatalogsRolesEdit);
app.component("catalogs-rolemodule", CatalogsRoleModule);
app.component("catalogs-users-edit", CatalogsUsersEdit);
app.component("profile", Profile);

app.mount("#app");
