import Vue from 'vue';

import Hello from './components/Hello'
import BookStore from './components/modules/BookStore'

new Vue({
    el: '#app',
    components: {
        Hello
        , BookStore
    }
});