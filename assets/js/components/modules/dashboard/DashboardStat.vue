<template>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 margin-bottom-10">
        <div :class="['dashboard-stat', color]">
            <div class="visual">
                <i :class="icon"></i>
            </div>

            <div class="details">
                <div class="number"> {{ value }} </div>
                <div class="desc"> {{ description }} </div>
            </div>

            <a class="more" :href="link">
                {{ viewMore }}
                <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "dashboard-stat",

        props: {
            description: {
                type: String,
                default: 'Books'
            },
            viewMore: {
                type: String,
                default: 'View more'
            },
            link: {
                type: String,
                default: 'javascript:;'
            },
            color: {
                type: String,
                default: 'blue'
            },
            icon: {
                type: String,
                default: 'icon icon-book-open'
            },
            url: {
                type: String,
                default: 'http://lms.com/api/book_models/count'
            },
            content: {
                type: String,
                default: 'booksCount'
            },
        },

        data () {
            return {
                value: 10
            }
        },

        mounted () {
            axios
                .get(
                    this.url,
                    {
                        headers: {
                            'Content-Type': 'application/json',
                            'accept': 'application/json'
                        }
                    }
                )
                .then(
                    response => (
                        this.value = response.data.hasOwnProperty(this.content)
                            ? response.data[this.content]
                            : 10
                    )
                )
        }
    }
</script>

<style scoped>

</style>