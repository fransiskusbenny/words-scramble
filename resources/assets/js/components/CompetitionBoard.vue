<script>
    import swal from 'sweetalert2'
    import moment from 'moment'

    export default {
        props: {
            requestQuestionEndpoint: String,
            checkAnswerEndpoint: String,
            storeGameEndpoint: String,
            updateScoresEndpoint: String,
            indexScoresEndpoint: String,
            channel: Object,
            competition: Object,
        },

        data() {
            return {
                word: {},
                correctWords: [],
                scores: 0,
                participants: [],
            }
        },

        created() {
            Echo.join(`competitions.${this.competition.id}`)
                .listen('Competitions\\UpdateScores', ({user, scores}) => {
                    this.findParticipants(user.id).scores = scores
                })
                .here(users => {
                    this.participants = users.map(user => ({...user, scores: 0}))
                })
                .joining(user => {
                    this.participants.push({...user, scores: 0})
                })
                .leaving(user => {
                    let participant = this.findParticipants(user.id),
                        index = this.participants.indexOf(participant)

                    this.participants.splice(index, 1)
                })

            this.$nextTick(() => {
                this.play()
            })

            $(window).on('beforeunload', function(){
                return 'Are you sure you want to leave?';
            });
        },

        watch: {
            participants() {
                // this.fetchParticipantsScores()
            }
        },

        computed: {
            participantsRanks() {
                return this.participants.sort((a, b) => b.scores - a.scores)
            }
        },

        methods: {
            play() {
                axios.get(this.requestQuestionEndpoint).then(({data}) => {
                    this.word = {
                        ...data,
                        answer: ''
                    }

                    this.$refs.countdown.start()
                })
            },

            check() {
                if (this.word.answer) {

                    this.word = {
                        ...this.word,
                        user_id: this.$loginUser.id
                    }

                    this.$refs.countdown.pause()

                    axios.post(this.checkAnswerEndpoint, this.word).then(({data}) => {
                        if (data.correct) {

                            this.scores += this.word.points
                            this.updateScores(this.scores);
                            this.correctWords.push(this.word)
                            return this.play()
                        }

                        this.scores -= 10
                        this.updateScores(this.scores);
                        this.wrongAnswerAlert()
                        return this.$refs.countdown.start()
                    })
                }
            },

            updateScores(scores) {
                axios.patch(this.updateScoresEndpoint, {
                    user: this.$loginUser, scores
                })
            },

            findParticipants(id) {
                return this.participants.find(user => user.id === id)
            },

            gameOver() {
                this.saveRecord()
                this.gameOverAlert()
            },

            gameOverAlert() {
                let scores = this.scores,
                    correctAnswerCount = this.correctWords.length,
                    ranks = this.participantsRanks.indexOf(this.findParticipants(this.$loginUser.id)) + 1

                swal({
                    title: 'Times out',
                    text: `Your ranks is ${ranks} with scores ${scores} & successful to solve ${correctAnswerCount} words`,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Back to home',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                }).then((result) => {
                    if (result.value) {
                        window.location.href = '/home'
                    }
                })
            },

            wrongAnswerAlert() {
                swal({type: 'error', title: 'Oops...', text: 'Your answer is wrong'})
            },

            saveRecord() {
                let {start_at, end_at} = this.competition,
                    data = {
                    competition: this.competition,
                    channel: this.channel,
                    scores: this.scores,
                    durations: moment(end_at).diff(start_at, 'seconds'),
                    correct_words: this.correctWords,
                }

                axios.post(this.storeGameEndpoint, data)
            },

            fetchParticipantsScores() {
                return new Promise(resolve => {
                    axios.get(this.indexScoresEndpoint).then(({data}) => {
                        this.participants.map(participant => {
                            data.map(d => {
                                if (d.user.id === participant.id) {
                                    return participant.scores = d.scores
                                }
                            })
                        })

                        resolve(data)
                    })
                })
            }
        }
    }
</script>
