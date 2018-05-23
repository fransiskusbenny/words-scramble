<div class="card" >
    <div class="card-header">Competitions</div>
    @if($competitions->count())
        <ul class="list-group">
            @foreach($competitions as $competition)
                <upcoming-competition-item :competition="{{ $competition }}"
                                           :is-join="@json($user->isParticipating($competition))"
                                           :is-start="@json($competition->isOngoing())"
                                           join-endpoint="{{ route('upcoming-competitions.join', $competition) }}"
                                           inline-template
                >
                    <li class="list-group-item flex-column align-items-start" >
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ $competition->channel->name }}</h5>
                            <span v-if="data.is_start">Ongoing</span>
                            <span class="lead" v-else>
                            Start in
                                <countdown class="badge badge-info"
                                               :seconds="{{ $competition->isOngoing() ? 0 : now()->diffInSeconds($competition->start_at) }}"
                                               @finished="start"
                                ></countdown>
                            </span>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 font-weight-bold col-form-label">Total
                                Participants:
                            </label>
                            <div class="col-sm-7">
                                <p class="form-control-plaintext" v-text="data.participants_count"></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 font-weight-bold col-form-label">
                                Description:
                            </label>
                            <div class="col-sm-7">
                                <p class="form-control-plaintext" v-text="data.description"></p>
                            </div>
                        </div>
                        <small>
                            <button @click="join" type="button" class="btn btn-sm" v-if="!data.is_start"
                                    :class="data.is_join ? 'btn btn-success' : 'btn-primary'">
                                @{{ data.is_join ? 'Joined' : 'Join' }}
                            </button>

                            <a href="{{ route('boards.competition', $competition) }}"
                               class="mr-2 btn btn-warning btn-sm" v-if="data.is_join && data.is_start">
                                Enter
                            </a>
                        </small>
                    </li>
                </upcoming-competition-item>
            @endforeach
        </ul>
    @else
        <div class="card-body">
            <p>No competitions available</p>
        </div>
    @endif
</div>