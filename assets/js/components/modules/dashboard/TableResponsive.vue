<template>
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th v-for="(columnLabel,key) in columnLabels" :key="key"> {{ columnLabel }} </th>
                    <th> </th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="(row, key) in rows" :key="key">
                    <td v-for="(columnName, key) in columnNames" :key="key" >
                        <a href="javascript:;" > {{ row[columnName] }} </a>
                    </td>

                    <td>
                        <a href="javascript:;" class="btn btn-sm btn-default">
                            <i class="fa fa-search"></i> View </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "table-responsive",

        props: {
            columnLabels: {
                type: Array,
                default: () => ['ID', 'Title']
            },
            columnNames: {
                type: Array,
                default: () => ['id', 'title']
            },
            url: {
                type: String,
                default: 'http://lms.com/api/book_models'
            },
        },

        data () {
            return {
                rows: []
            }
        },

        mounted () {
            axios
                .get(
                    this.url,
                    {
                        headers: {
                            'Accept': 'application/json',
                        }
                    }
                )
                .then(
                    response => (
                        this.rows = response.data
                    )
                )
        }
    }
</script>

<style scoped>

</style>