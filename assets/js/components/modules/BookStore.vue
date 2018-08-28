<template>
    <div class="m-portlet m-portlet--mobile ">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Book from source
                    </h3>
                </div>
            </div>

            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                            <a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                                <i class="la la-ellipsis-h m--font-brand"></i>
                            </a>
                            <div class="m-dropdown__wrapper">
                                <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                <div class="m-dropdown__inner">
                                    <div class="m-dropdown__body">
                                        <div class="m-dropdown__content">
                                            <ul class="m-nav">
                                                <li class="m-nav__section m-nav__section--first">
                                                    <span class="m-nav__section-text">Quick Actions</span>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-share"></i>
                                                        <span class="m-nav__link-text">Create Post</span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                        <span class="m-nav__link-text">Send Messages</span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-multimedia-2"></i>
                                                        <span class="m-nav__link-text">Upload File</span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__section">
                                                    <span class="m-nav__section-text">Useful Links</span>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-info"></i>
                                                        <span class="m-nav__link-text">FAQ</span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                        <span class="m-nav__link-text">Support</span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__separator m-nav__separator--fit m--hide">
                                                </li>
                                                <li class="m-nav__item m--hide">
                                                    <a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">Submit</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>				</li>
                </ul>
            </div>
        </div>

        <div class="m-portlet__body">
            <!--begin: Datatable -->
            <div class="m_datatable" id="m_datatable_latest_orders">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                    <thead>
                    <tr>
                        <th>Record ID</th>
                        <th>Order ID</th>
                        <th>Country</th>
                        <th>Ship City</th>
                        <th>Ship Address</th>
                        <th>Company Agent</th>
                        <th>Company Name</th>
                        <th>Ship Date</th>
                        <th>Status</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                    </thead>


                </table>
            </div>
            <!--end: Datatable -->
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "hello",

        data () {
            return {
                books: []
            }
        },

        mounted () {
            axios
                .get('http://127.0.0.1:8000/api/books')
                .then(response => (this.books = response.data['hydra:member']))
        }
    }












    /*
    0 !== $("#m_datatable_latest_orders").length && $(".m_datatable").mDatatable({
               data: {
                   // type: "remote",
                   // source: {read: {url: "inc/api/datatables/demos/default.php"}},
                   pageSize: 10,
                   saveState: {cookie: !1, webstorage: !0},
                   serverPaging: !0,
                   serverFiltering: !0,
                   serverSorting: !0
               },
               layout: {theme: "default", class: "", scroll: !0, height: 380, footer: !1},
               sortable: !0,
               filterable: !1,
               pagination: !0,
               columns: [
                   {
                   field: "RecordID",
                   title: "#",
                   sortable: !1,
                   width: 40,
                   selector: {class: "m-checkbox--solid m-checkbox--brand"},
                   textAlign: "center"
               }, {
                   field: "OrderID",
                   title: "Order ID",
                   sortable: "asc",
                   filterable: !1,
                   width: 150,
                   template: "{{ OrderID }} - {{ ShipCountry }}"
               }, {
                   field: "ShipName",
                   title: "Ship Name",
                   width: 150,
                   responsive: {visible: "lg"}
               }, {field: "ShipDate", title: "Ship Date"}, {
                   field: "Status",
                   title: "Status",
                   width: 100,
                   template: function (e) {
                       var t = {
                           1: {title: "Pending", class: "m-badge--brand"},
                           2: {title: "Delivered", class: " m-badge--metal"},
                           3: {title: "Canceled", class: " m-badge--primary"},
                           4: {title: "Success", class: " m-badge--success"},
                           5: {title: "Info", class: " m-badge--info"},
                           6: {title: "Danger", class: " m-badge--danger"},
                           7: {title: "Warning", class: " m-badge--warning"}
                       };
                       return '<span class="m-badge ' + t[e.Status].class + ' m-badge--wide">' + t[e.Status].title + "</span>"
                   }
               }, {
                   field: "Type", title: "Type", width: 100, template: function (e) {
                       var t = {
                           1: {title: "Online", state: "danger"},
                           2: {title: "Retail", state: "primary"},
                           3: {title: "Direct", state: "accent"}
                       };
                       return '<span class="m-badge m-badge--' + t[e.Type].state + ' m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-' + t[e.Type].state + '">' + t[e.Type].title + "</span>"
                   }
               }, {
                   field: "Actions",
                   width: 110,
                   title: "Actions",
                   sortable: !1,
                   overflow: "visible",
                   template: function (e, t, a) {
                       return '                        <div class="dropdown ' + (a.getPageSize() - t <= 4 ? "dropup" : "") + '">                            <a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown">                                <i class="la la-ellipsis-h"></i>                            </a>                            <div class="dropdown-menu dropdown-menu-right">                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>                            </div>                        </div>                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">                            <i class="la la-edit"></i>                        </a>                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">                            <i class="la la-trash"></i>                        </a>                    '
                   }
               }
           ]
           })
    */
</script>

<style scoped>

</style>