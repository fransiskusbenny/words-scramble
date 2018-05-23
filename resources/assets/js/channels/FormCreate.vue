<template>
    <form @submit.prevent="submit">
        <div class="card">
           <div class="card-header">
               Add New Channels
           </div>

            <div class="card-body">
                <validation-errors :error="error"></validation-errors>

                <div class="form-group row">
                    <label class="col-form-label text-right col-md-3">Channel Name</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" v-model="form.name">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-sm-3 text-right">Words
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
                                    <select class="form-control" v-model="word.mode">
                                        <option value="" disabled selected>Select a channel</option>
                                        <option :value="mode.id" v-for="mode in modes">{{ mode.text }}</option>
                                    </select>
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
            redirectTo: String,
            data: {
                default: false
            },
            modes: [],
        },

        data() {
            return {
                form: {
                    name: '',
                    words: [
                        {
                            text: '',
                            hint: '',
                            mode: '',
                        }
                    ]
                },
                error: false
            }
        },

        methods: {
            submit() {
                axios.post(this.endpoint, this.form).then(res => {
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
                    mode: '',
                })
            }
        }
    }
</script>