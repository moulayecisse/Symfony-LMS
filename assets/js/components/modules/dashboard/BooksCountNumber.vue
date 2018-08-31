<template>
    <span>{{ booksCount }}</span>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "dashboard-books-count-number",

        data () {
            return {
                booksCount: 0
            }
        },

        mounted () {
            axios
                .get('http://127.0.0.1:8000/api/books/count')
                .then(response => (this.booksCount = response.data.booksCount))
        }
    }
</script>

<style scoped>

</style>