<template>
    <div class="card">
        <div class="card-header">Leaderboard</div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Mode</label>
                        <select class="form-control" v-model="params.mode">
                            <option value="">All</option>
                            <option :value="mode.text" v-for="mode in modes" v-text="mode.text"></option>
                            <option value="competition">Competition</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Period</label>
                        <select class="form-control" v-model="params.period">
                            <option value="">All period</option>
                            <option value="today">Today</option>
                            <option value="month">This Month</option>
                            <option value="year">This Year</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                <tr>
                    <th>User</th>
                    <th>Scores</th>
                    <th>Mode</th>
                    <th>Time</th>
                </tr>
                </thead>
                <tbody v-if="games.length > 0">
                <tr v-for="(game, index) in games">
                    <td>{{ game.user.name }}</td>
                    <td>{{ game.scores }}</td>
                    <td>{{ game.mode.text }}</td>
                    <td>{{ game.created_at | fromNow }}</td>
                </tr>
                </tbody>
                <tr v-else>
                    <td colspan="4">No records found.</td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'

    export default {
        props: ['endpoint', 'modes'],

        data() {
            return {
                games: [],
                params: {
                    mode: '',
                    period: ''
                }
            }
        },

        mounted() {
            this.getRanks()
        },

        watch: {
            params: {
                handler(val){
                    this.getRanks(val.mode, val.period)
                },
                deep: true
            }
        },

        filters: {
            fromNow(value) {
                return moment(value).fromNow()
            }
        },

        methods: {
            getRanks(mode = '', period = '') {
                window.axios.get(`${this.endpoint}?mode=${mode}&period=${period}`).then(res => {
                    this.games = res.data
                })
            }
        }
    }
</script>