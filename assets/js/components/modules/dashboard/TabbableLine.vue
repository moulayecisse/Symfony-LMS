<template>
    <div class="tabbable-line">
        <ul class="nav nav-tabs">
            <li :class="key === 0 ? 'active' : ''" v-for="(label, key) in labels" :key="key">
                <a :href="'#' + key" data-toggle="tab"> {{ label }} </a>
            </li>

            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> Orders
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu pull-right">
                    <li>
                        <a href="#overview_4" data-toggle="tab">
                            <i class="icon-bell"></i> Latest 10 Orders </a>
                    </li>
                    <li>
                        <a href="#overview_4" data-toggle="tab">
                            <i class="icon-info"></i> Pending Orders </a>
                    </li>
                    <li>
                        <a href="#overview_4" data-toggle="tab">
                            <i class="icon-speech"></i> Completed Orders </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#overview_4" data-toggle="tab">
                            <i class="icon-settings"></i> Rejected Orders </a>
                    </li>
                </ul>
            </li>
        </ul>

        <div class="tab-content">
            <div :class="key === 0 ? 'tab-pane active' : 'tab-pane'" v-for="(id, key) in ids" :key="key" :id="key">
                <div class="scroller" style="height: 339px;" data-always-visible="1" data-rail-visible="0">
                    <slot :name="id"></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "tabbable-line",

        props: {
            labels: {
                type: Array,
                default: () => ['ID', 'Title']
            },
            ids: {
                type: Array,
                default: () => ['id', 'title']
            }
        }
    }
</script>

<style scoped>

</style>