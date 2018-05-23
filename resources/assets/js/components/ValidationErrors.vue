<template>
    <div class="alert alert-danger alert-dismissible fade show" v-if="data">
        <strong><i class="fa fa-ban"></i> {{ data.message }}</strong>
        <ul class="mb-0">
            <li v-for="value in data.lists" v-text="value"></li>
        </ul>
        <button type="button" class="close" @click="data = false">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</template>

<script>
    export default {
        props: {
            error: {
                default: false
            }
        },

        data() {
            return {
                data: this.error
            }
        },

        watch: {
            error(val) {
                if (val) {
                    this.displayError(val)
                }
            }
        },

        methods: {
            displayError({errors, message}) {
                this.data = {
                    message,
                    lists: _.flatten(_.toArray(errors))
                }
            },
        }
    }
</script>