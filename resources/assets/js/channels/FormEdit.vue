<template>
    <div class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <validation-errors :error="error"></validation-errors>
                    <div class="form-group row">
                        <label class="col-form-label col-md-4">Channel Name</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" v-model="form.name">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="submit">Submit</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ValidationErrors from '../components/ValidationErrors'

    export default {
        components: {ValidationErrors},

        props: {
            endpoint: String,
            method: String,
            title: String,
            data: {
                default: false
            }
        },

        data() {
            return {
                form: {},
                error: false
            }
        },

        mounted() {
            this.fillForm()
        },

        methods: {
            submit() {
                axios[this.method](this.endpoint, this.form).then(res => {
                    this.error = false
                    $(this.$el).modal('hide')
                }).catch(({response}) => {
                    if (response && response.status === 422) {
                       this.error = response.data
                    }
                })
            },

            fillForm() {
                if (this.data) {
                    return this.form = {
                        ...this.data
                    }
                }
            }
        }
    }
</script>