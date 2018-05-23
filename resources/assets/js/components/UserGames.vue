<template>
    <div class="card">
        <div class="card-header">Games Histories</div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover m-0">
                <thead>
                <tr>
                    <th class="sortable" @click="sortBy('channel_id')">Channel <span class="float-right" v-html="this.getSortIcon('channel_id')"></span></th>
                    <th class="sortable" @click="sortBy('mode_id')">Mode <span class="float-right" v-html="this.getSortIcon('mode_id')"></span></th>
                    <th class="sortable" @click="sortBy('scores')">Scores <span  class="float-right" v-html="this.getSortIcon('scores')"></span></th>
                    <th class="sortable" @click="sortBy('created_at')">Time <span class="float-right" v-html="this.getSortIcon('created_at')"></span></th>
                    <th></th>
                </tr>
                </thead>
                <tbody v-if="games.data.length > 0">
                <tr v-for="(game, index) in games.data">
                    <td>{{ game.channel }}</td>
                    <td>{{ game.mode }}</td>
                    <td>{{ game.scores }}</td>
                    <td>{{ game.human_time }}</td>
                    <td class="text-center" width="10%">
                        <a class="btn btn-info btn-sm" href="#" :data-target="`#details-${index}`" data-toggle="modal">View Details</a>
                        <!-- Modal -->
                        <div class="modal fade" :id="`details-${index}`" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Word Solved Count {{ game.words_solved_count }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center" v-for="word in game.histories">
                                            {{ word.solved_word }}
                                            <span class="badge badge-primary badge-pill">{{ word.points }}</span>
                                        </li>
                                    </ul>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
                <tr v-else>
                    <td colspan="5">No games records found.</td>
                </tr>
            </table>
        </div>
        <div class="card-footer" v-if="games.meta.last_page > 1">
            <nav>
                <ul class="pagination justify-content-between mb-0">
                    <li class="page-item"><a class="page-link" @click="page -= 1" v-if="games.meta.current_page > 1">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" @click="page += 1" v-if="games.meta.last_page !== page">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['indexGamesEndpoint'],

        data() {
            return {
                games: {
                    meta: {},
                    data: [],
                    links: {}
                },
                page: 1,
                sort: {
                    column: '',
                    dir: ''
                }
            }
        },

        watch: {
            page(val) {
                this.get(val)
            },
            sort: {
                handler(val) {
                    this.get(this.page, val.column, val.dir)
                }
            }
        },

        created() {
            this.get()
        },

        methods: {
            get(page = 1, sortColumn = null, sortDirection = 'asc') {
                let qs = `page=${page}`

                if (sortColumn && sortDirection) {
                    qs += `&sort=${sortColumn}|${sortDirection}`
                }

                axios.get(`${this.indexGamesEndpoint}/?${qs}`)
                    .then(res => {
                    this.games = res.data
                })
            },

            sortBy(column) {
                this.sort = {
                    column,
                    dir: this.sort.dir === 'asc' ? 'desc' : 'asc'
                }
            },

            getSortIcon(column) {
                let sort = this.sort
                if (sort.column === column) {
                    if (sort.dir === 'asc') {
                        return '<i class="fa fa-sort-asc fa-fw"></i>'
                    }
                    return '<i class="fa fa-sort-desc fa-fw"></i>'
                }

                return '<i class="fa fa-sort fa-fw"></i>'
            }
        }
    }
</script>

<style scoped>
    th, td {
        white-space: nowrap !important;
    }

    th.sortable {
        cursor: pointer;
    }
</style>