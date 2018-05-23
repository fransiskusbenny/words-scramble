<script>
    import {destroy} from '../utils'
    export default {
        props: ['destroyEndpoint'],

        methods: {
            destroy() {
                destroy(this.destroyEndpoint).then((res) => {
                    window.location.reload()
                })
            }
        }
    }
</script>