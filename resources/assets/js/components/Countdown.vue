<template>
    <span class="small" :class="{'text-danger': remaining.hours <= 0 && remaining.hours <= 0 &&  remaining.minutes <= 0}">
        <span v-if="remaining.days > 0">{{ remaining.days }} days</span>
        <span v-if="remaining.hours > 0">{{ remaining.hours }} hours</span>
        <span v-if="remaining.minutes > 0">{{ remaining.minutes }} minutes</span>
        <span v-if="remaining.seconds > 0">{{ remaining.seconds }} seconds</span>
    </span>
</template>

<script>
    import moment from 'moment'

    export default {
        props: {
            seconds: {
                default: 10
            }
        },

        data() {
            return {
                interval: 0,
                paused: false
            }
        },

        mounted() {
            let interval = setInterval(() => {
                if (!this.paused) {
                    this.interval += 1000
                }
            }, 1000)

            this.$on('finished', () => clearInterval(interval));
        },

        computed: {
            remaining() {
                let milliseconds = moment.duration(this.seconds, 'seconds').asMilliseconds(),
                    remaining = moment.duration(milliseconds -  this.interval)

                if (remaining <= 0) this.$emit('finished');
        
                return {
                    days: remaining.days(),
                    hours: remaining.hours(),
                    minutes: remaining.minutes(),
                    seconds: remaining.seconds(),
                }
            }
        },

        methods: {
            start() {
                return this.paused = false
            },

            pause() {
                return this.paused = true
            },

            restart() {
                return this.interval = 0
            }
        }
    }
</script>
