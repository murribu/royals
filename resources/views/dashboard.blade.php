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
        <div class="game" v-for="game in games" :class="{'active': game.id = selected.game}" @click="selectGame(game)">
            @{{game.away_team.name}} @ @{{game.home_team.name}}
        </div>
    </div>
</template>
@endsection