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
                    <label class="col-form-label col-sm-3 text-right">Modes:</label>
                    <div  class="col-md-9">
                        <select class="form-control" v-model="form.mode">
                            <option value="" selected disabled>Select a mode</option>
                            <option :value="mode.id" v-for="mode in modes">{{ mode.text }}</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-sm-3 text-right">Words:
                        <a href="#" class="text-primary" @click.prevent="addWord"><i class="fa fa-plus"></i></a>
                    </label>
                    <div class="col-md-9">
                        <template v-for="(word, index) in form.words">
                            <div class="form-group row">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" v-model="word.text" placeholder="words">
                                </div>
                                <div class="col-md-2">
                                     {{ index + 1 }} <a href="#" class="text-danger" @click.prevent="form.words.splice(index, 1)"><i class="fa fa-times"></i></a>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-10">
                                    <textarea rows="3" class="form-control" v-model="word.hint" placeholder="hint"></textarea>
                                </div>
                            </div>
                        </template>
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
            modes: Array
        },

        data() {
            return {
                form: {
                    channel: '',
                    mode: '',
                    words: [{
                        text: '',
                        hint: '',
                    }],
                },
                error: false
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

            addWord() {
                return this.form.words.push({
                    text: '',
                    hint: '',
                    suffles: 1
                })
            }
        }
    }
</script>