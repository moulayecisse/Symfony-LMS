<template>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 margin-bottom-10">
        <div class="dashboard-stat blue">
            <div class="visual">
                <i class="fa fa-briefcase fa-icon-medium"></i>
            </div>

            <div class="details">
                <div class="number"> {{ booksCount }} </div>
                <div class="desc"> Lifetime Sales </div>
            </div>

            <a class="more" href="javascript:;"> View more
                <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "hello",

        data () {
            return {
                booksCount: 0
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