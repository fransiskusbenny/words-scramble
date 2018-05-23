<script>
    import swal from 'sweetalert2'

    export default {
        props: {
            requestQuestionEndpoint: String,
            checkAnswerEndpoint: String,
            saveGameEndpoint: String,
            channel: Object,
            mode: Object
        },

        data() {
            return {
                word: {},
                correctWords: [],
                scores: 0,
            }
        },

        created() {
            this.$nextTick(() => {
                this.play()
            })
        },

        methods: {
            play() {
                this.$refs.countdown.pause()

                window.axios.get(this.requestQuestionEndpoint).then(({data}) => {
                    this.word = {
                        ...data,
                        answer: ''
                    }

                    this.$refs.countdown.start()
                })
            },

            check() {
                if (this.word.answer) {
                    this.$refs.countdown.pause()

                    window.axios.post(this.checkAnswerEndpoint, this.word).then(({data}) => {
                        if (data.correct) {
                            this.correctWords.push(this.word)
                            this.scores += this.word.points;
                            return this.play()
                        }

                        this.wrongAnswerAlert()
                        this.scores -= 10;
                        return this.$refs.countdown.start()
                    })
                }
            },

            gameOver() {
                this.saveRecord()
                this.gameOverAlert()
            },

            gameOverAlert() {
                let scores = this.scores,
                    correctAnswerCount = this.correctWords.length

                swal({
                    title: 'Times out',
                    text: `Your score is ${scores} & successful to solve ${correctAnswerCount} words`,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Restart game',
                    cancelButtonText: 'Back to home',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                }).then((result) => {
                    if (result.value) {
                        window.location.reload()
                    } else {
                        window.location.href = '/home'
                    }
                })
            },

            wrongAnswerAlert() {
                swal({type: 'error', title: 'Oops...', text: 'Your answer is wrong'})
            },

            saveRecord() {
                let data = {
                    mode: this.mode,
                    channel: this.channel,
                    scores: this.scores,
                    durations: this.$refs.countdown.seconds,
                    correct_words: this.correctWords,
                }

                window.axios.post(this.saveGameEndpoint, data)
            }
        }
    }
</script>
