import Vue from 'vue';

import DashboardBooksCount from './components/modules/dashboard/BooksCount'
import DashboardBooksCountNumber from './components/modules/dashboard/BooksCountNumber'

new Vue(
    {
        el: '#app',

        components: {
            DashboardBooksCount
            , DashboardBooksCountNumber
        }
    }
);