<template>
    <form @submit.prevent="submit">
        <div class="card">
            <slot name="title"></slot>

            <div class="card-body">
                <validation-errors :error="error"></validation-errors>

                <div class="form-group row">
                    <label class="col-form-label col-sm-3 text-right">Channel:</label>
                    <div class="col-md-9">
                        <select class="form-control" v-model="form.channel">
                            <option value="" selected disabled>Select a channel</option>
                            <option :value="channel.id" v-for="channel in channels">{{ channel.name }}</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-sm-3 text-right">Start at:</label>
                    <div class="col-md-9">
                        <input type="datetime-local" class="form-control" v-model="form.start_at">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-sm-3 text-right">End at:</label>
                    <div class="col-md-9">
                        <input type="datetime-local" class="form-control" v-model="form.end_at">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-sm-3 text-right">Descriptions:</label>
                    <div class="col-md-9">
                        <textarea class="form-control" v-model="form.description" rows="3"></textarea>
                    </div>
                </div>


                <div class="form-group row mb-0">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    import ValidationErrors from "../components/ValidationErrors";
    import moment from 'moment'

    export default {
        components: {ValidationErrors},
        props: {
            endpoint: String,
            method: String,
            redirectTo: String,
            data: {
                default: false
            },
            channels: Array,
        },

        data() {
            return {
                form: {
                    channel: '',
                    start_at: '',
                    end_at: '',
                    description: ''
                },
                error: false
            }
        },

        mounted() {
            if (this.data) {
                let {channel_id, start_at, end_at, description} = this.data
                this.form = {
                    channel: channel_id,
                    start_at: moment(start_at).format('YYYY-MM-DDTHH:mm'),
                    end_at: moment(end_at).format('YYYY-MM-DDTHH:mm'),
                    description
                }
            }
        },

        methods: {
            submit() {
                axios[this.method](this.endpoint, this.form).then(res => {
                    window.location.replace(this.redirectTo)
                }).catch(({response}) => {
                    if (response && response.status === 422) {
                        this.error = response.data
                    }
                })
            },
        }
    }
</script>