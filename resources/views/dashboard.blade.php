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
                @{{game.away_team}} @ @{{game.home_team}}
            </div>
        </div>
    </div>
    <div class="game" v-show="gameIsSelected">
        <div class="back">
            <a href="#" @click="selected.game = {}">&lt; Back</a>
        </div>
        <h3>@{{selected.game.away_team + ' @ ' + selected.game.home_team + ' - ' + monthnames[selected.month] + ' ' + selected.day + ', ' + selected.year}}</h3>
        <ul class="nav nav-tabs">
            <li v-for="i in selected.game.innings" :class="{'active': i == selected.inning.inning}"><a href="#" @click="selectInning(i)" :class="{'active': i == selected.inning.inning}">@{{ordinal(i)}}</a></li>
        </ul>
        <ul class="nav nav-tabs">
            <li v-for="pa in selected.inning.plate_appearances" 
                style="text-align:center"
                :data-info-badge="pa.pitch_count" 
                :data-bad-badge="pa.discrepancies" 
                :title="pa.discrepancies + ' discrepancies' + pa.pitch_count + ' pitches, '"
                :class="{
                        'active': selected.plate_appearance.pa_number == pa.pa_number, 
                        'has-info-badge': pa.pitch_count > 0, 
                        'has-bad-badge': pa.discrepancies > 0
                        }"><a href="#" @click="selectPlateAppearance(pa.pa_number)">@{{pa.batter}}<br>@{{pa.pitcher}}</a></li>
        </ul>
        <div class="plate-appearance" v-show="paIsSelected">
            <table class="table">
                <thead>
                    <tr style="text-align:center">
                        <th>Truth</th>
                        <th>Pfx</th>
                        <th>Stats</th>
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
                                    </tr>
                                    <tr v-for="pitch in selected.plate_appearance.pitches">
                                        <td>@{{pitch.pa_sequence}}</td>
                                        <td>@{{pitch.pitch_type_name}}</td>
                                        <td>@{{pitch.velocity}}</td>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="pitch in selected.plate_appearance.pfx_pitches">
                                        <td>@{{pitch.pa_sequence}}</td>
                                        <td>@{{pitch.pitch_name}}</td>
                                        <td>@{{pitch.initial_speed}}</td>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="pitch in selected.plate_appearance.stats_pitches">
                                        <td>@{{pitch.pa_sequence}}</td>
                                        <td>@{{pitch.pitch_type.name}}</td>
                                        <td>@{{pitch.stats_velocity}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
@endsection