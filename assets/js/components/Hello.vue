<template>
    <div class="hello">
        <ul>
            <li v-for="(book, index) in books" :key="index">{{book.title}}</li>
        </ul>
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
</script>

<style scoped>

</style>