import Vue from 'vue';

import Hello from './components/Hello'
import BookStore from './components/modules/BookStore'
import DashBoardBookCount from './components/modules/dashboard/BookCount'
import DashboardBooksCountNumber from './components/modules/dashboard/BooksCountNumber'

new Vue({
    el: '#app',
    components: {
        Hello
        , BookStore
        , DashBoardBookCount
        , DashboardBooksCountNumber
    }
});