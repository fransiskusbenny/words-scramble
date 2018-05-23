<template>
    <div class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Game Settings</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Modes</label>
                        <select class="form-control" v-model="mode">
                            <option value="" >Random modes</option>
                            <option :value="mode.text" v-for="mode in modes" v-text="mode.text"></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Channels</label>
                        <select class="form-control" v-model="channel">
                            <option value="" >Random channels</option>
                            <option :value="channel.name" v-for="channel in channels" v-text="channel.name"></option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="startGame">Start Game</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['modes', 'channels', 'boardEndpoint'],

        data() {
            return {
                mode: '',
                channel: ''
            }
        },

        methods: {
            startGame() {
                window.location.href = `${this.boardEndpoint}?mode=${this.mode}&channel=${this.channel}`
            }
        }
    }
</script>