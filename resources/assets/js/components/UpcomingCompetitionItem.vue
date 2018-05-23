<script>
    export default {
        props: ['competition', 'isJoin', 'isStart','joinEndpoint'],

        data() {
            return {
                data: {
                    ...this.competition,
                    is_join: this.isJoin,
                    is_start: this.is_start
                },
            }
        },

        methods: {
            join() {
                window.axios.post(this.joinEndpoint).then(({data}) => {
                    this.data.is_join = data.is_join

                    if (data.is_join) {
                        return this.data.participants_count += 1
                    }
                    return this.data.participants_count -= 1
                })
            },

            start() {
                return this.data.is_start = true
            }
        },
    }
</script>