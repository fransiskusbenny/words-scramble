
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.events = new Vue()
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('Countdown', require('./components/Countdown.vue'));
Vue.component('BasicBoard', require('./components/BasicBoard.vue'))
Vue.component('CompetitionBoard', require('./components/CompetitionBoard.vue'))
Vue.component('Leaderboard', require('./components/Leaderboard'))
Vue.component('NewGameSettings', require('./components/NewGameSettings'))
Vue.component('UpcomingCompetitionItem', require('./components/UpcomingCompetitionItem'))
Vue.component('UserGames', require('./components/UserGames'));

Vue.component('FormCompetitions', require('./competitions/Form'))
Vue.component('TableActionsCompetitions', require('./competitions/TableActions'))

Vue.component('FormWords', require('./words/Form'))

Vue.component('FormCreateChannel', require('./channels/FormCreate'))
Vue.component('FormEditChannel', require('./channels/FormEdit'))

Vue.prototype.$loginUser = window.login_user

const app = new Vue({
    el: '#app'
});

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
