@extends('template')

@section('scripts')
<script type="text/javascript" src="js/dashboard.vue.js"></script>
<script type="text/javascript">
    var token = '{{csrf_token()}}';
</script>
@endsection

@section('content')
@include('nav')

<div class="container" style="padding-top:60px;" id="dashboard">
    <dashboard></dashboard>
</div>
<template id="dashboard-template">
    <div v-show="!gameIsSelected">
        <ul class="nav nav-tabs" v-show="years">
            <li v-for="year in years" :class="{'active': year == selected.year}"><a href="#"@click="selectYear(year)">@{{year}}</a></li>
        </ul>
        <ul class="nav nav-tabs" v-show="months">
            <li v-for="month in months" :class="{'active': month == selected.month}"><a href="#"@click="selectMonth(month)">@{{monthnames[month]}}</a></li>
        </ul>
        <ul class="nav nav-tabs" v-show="days">
            <li v-for="day in days" :class="{'active': day == selected.day}"><a href="#"@click="selectDay(day)">@{{day}}</a></li>
        </ul>
        <div class="games-container" v-show="games">
            <div class="game-button" v-for="game in games" :class="{'active': game.id == selected.game}" @click="selectGame(game)">
                @{{game.away_team}} <br>@ @{{game.home_team}}
            </div>
        </div>
    </div>
    <div class="game" v-show="gameIsSelected">
        <div class="back">
            <a href="#" @click="selected.game = {}">&lt; Back</a>
        </div>
        <h3>@{{selected.game.away_team + ' @ ' + selected.game.home_team + ' - ' + monthnames[selected.month] + ' ' + selected.day + ', ' + selected.year}}</h3>
        <ul class="nav nav-tabs">
            <li v-for="i in selected.game.innings" 
                :class="{'active': i.inning == selected.inning.inning, 'has-bad-badge': i.discrepancies > 0}"
                :data-bad-badge="i.discrepancies"><a href="#" @click="selectInning(i.inning)" :class="{'active': i.inning == selected.inning.inning}">@{{ordinal(i.inning)}}</a></li>
        </ul>
        <ul class="nav nav-tabs">
            <li v-for="pa in selected.inning.plate_appearances" 
                style="text-align:center"
                :data-info-badge="pa.pitch_count" 
                :data-bad-badge="pa.discrepancies" 
                :title="pa.discrepancies + ' discrepancies, ' + pa.pitch_count + ' pitches'"
                :class="{
                        'active': selected.plate_appearance.pa_number == pa.pa_number, 
                        'has-info-badge': pa.pitch_count > 0, 
                        'has-bad-badge': pa.discrepancies > 0
                        }"><a href="#" @click="selectPlateAppearance(pa.pa_number)">@{{pa.batter}}<br>@{{pa.pitcher}}</a></li>
        </ul>
        <div class="plate-appearance" v-show="paIsSelected">
            <table class="table">
                <thead>
                    <tr>
                        <th><h3>Truth</h3></th>
                        <th><h3>Pfx</h3></th>
                        <th><h3>Stats</h3></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>SeqNum</th>
                                        <th>Pitch</th>
                                        <th>Velo</th>
                                        <th>Event</th>
                                    </tr>
                                    <tr v-for="pitch in selected.plate_appearance.pitches">
                                        <td>@{{pitch.pa_sequence}}</td>
                                        <td>@{{pitch.pitch_type_name}}</td>
                                        <td>@{{pitch.velocity}}</td>
                                        <td>@{{pitch.event_type}}</td>
                                    </tr>
                                </thead>
                            </table>
                        </td>
                        <td>
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>SeqNum</th>
                                        <th>Pitch</th>
                                        <th>Velo</th>
                                        <th>Event</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="pitch in selected.plate_appearance.pfx_pitches">
                                        <td>@{{pitch.pa_sequence}}</td>
                                        <td :class="{'discrepancy' : pitch.discrepancies.pitch_type}"
                                            @click="selectDiscrepancy(pitch, 'pitch_type')">@{{pitch.pitch_name}}</td>
                                        <td>@{{pitch.initial_speed}}</td>
                                        <td :class="{'discrepancy' : pitch.discrepancies.event_code}"
                                            @click="selectDiscrepancy(pitch, 'event_code')">@{{pitch.event_type}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>SeqNum</th>
                                        <th>Pitch</th>
                                        <th>Velo</th>
                                        <th>Event</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="pitch in selected.plate_appearance.stats_pitches">
                                        <td>@{{pitch.pa_sequence}}</td>
                                        <td :class="{'discrepancy' : pitch.discrepancies.pitch_type}"
                                            @click="selectDiscrepancy(pitch, 'pitch_type')">@{{pitch.pitch_name}}</td>
                                        <td>@{{pitch.stats_velocity}}</td>
                                        <td :class="{'discrepancy' : pitch.discrepancies.event_code}"
                                            @click="selectDiscrepancy(pitch, 'event_code')">@{{pitch.event_type}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="discrepancy" v-show="discrepancyIsSelected">
                <div class="row">
                    <div class="col-xs-4">
                        <h3>Truth</h3>
                    </div>
                    <div class="col-xs-4">
                        <h3>Pfx</h3>
                    </div>
                    <div class="col-xs-4">
                        <h3>Stats</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <input class="form-control" :value="selected.discrepancy.truth" readonly />
                    </div>
                    <div class="col-xs-4">
                        <input class="form-control" :value="selected.discrepancy.pfx" readonly />
                    </div>
                    <div class="col-xs-4">
                        <input class="form-control" :value="selected.discrepancy.stats" readonly />
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <button class="btn btn-primary" @click="resolveDiscrepancy()">Mark as Resolved</button>
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-primary" 
                                v-show="selected.discrepancy.truth != selected.discrepancy.pfx"
                                @click="chooseSource('pfx')">Choose</button>
                        <button class="btn btn-default" disabled v-show="selected.discrepancy.truth == selected.discrepancy.pfx">Chosen</button>
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-primary" 
                                v-show="selected.discrepancy.truth != selected.discrepancy.stats"
                                @click="chooseSource('stats')">Choose</button>
                        <button class="btn" disabled v-show="selected.discrepancy.truth == selected.discrepancy.stats">Chosen</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <h4>Refer to <a :href="selected.game.bbref_url" target="_new">Baseball-Reference.com</a> for more info.</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
@endsection