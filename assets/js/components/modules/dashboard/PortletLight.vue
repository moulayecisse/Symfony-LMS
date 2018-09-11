<template>
    <div class="portlet light ">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-share font-blue"></i>

                <span class="caption-subject font-blue bold uppercase">{{ title }}</span>

                <span class="caption-helper">{{ description }}</span>
            </div>

            <div class="actions">
                <div class="btn-group">
                    <a class="btn green btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li v-for="(action, key) in actions" :key="key">
                            <a :href="action.link"> {{ action.title }} </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="portlet-body">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        name: "portlet-light",

        props: {
            title: {
                type: String,
                default: 'Title'
            },
            description: {
                type: String,
                default: 'portlet description...'
            },
            Actions: {
                type: Array,
                default: () => [
                    {
                        label : 'An action',
                        link : 'javascript:;',
                    },
                    {
                        label : 'An action',
                        link : 'javascript:;',
                    },
                ]
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