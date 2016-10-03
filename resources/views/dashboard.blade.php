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
            <li v-for="pa in selected.inning.plate_appearances" :data-pitch-count="pa.pitch_count" :class="{'active': selected.plate_appearance.pa_number == pa.pa_number}"><a href="#" @click="selectPlateAppearance(pa.pa_number)">@{{pa.batter}} v @{{pa.pitcher}}</a></li>
        </ul>
    </div>
</template>
@endsection