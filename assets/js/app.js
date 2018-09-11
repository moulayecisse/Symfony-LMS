import Vue from 'vue';

import DashboardStat from './components/modules/dashboard/DashboardStat'
import TableResponsive from './components/modules/dashboard/TableResponsive'
import TabbableLine from './components/modules/dashboard/TabbableLine'
import PortletLight from './components/modules/dashboard/PortletLight'

new Vue(
    {
        el: '#app',

        components: {
            DashboardStat,
            TableResponsive,
            TabbableLine,
            PortletLight,
        }
    }
);