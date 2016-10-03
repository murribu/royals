Vue.component('dashboard',{
    template: '#dashboard-template',
    data: function(){
        return {
            selected: {
                year: '',
                month: '',
                day: '',
                game: {
                    away_team:{},
                    home_team:{},
                    innings:[1,2,3,4,5,6,7,8,9],
                },
                inning: {
                    inning:1,
                    plate_appearances:[],
                },
                plate_appearance:{
                    pa_number: 0,
                    pitches:[],
                    pfx_pitches:[],
                    stats_pitches:[],
                }
            },
            years: [],
            months: [],
            days: [],
            games: [],
            monthnames: ['', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Nov', 'Dec'],
        };
    },
    created: function(){
        this.loadYears();
    },
    computed: {
        gameIsSelected: function(){
            return typeof(this.selected.game.game_id) != 'undefined';
        },
        paIsSelected: function(){
            return typeof(this.selected.plate_appearance.pitches[0]) != 'undefined';   
        }
    },
    methods: {
        ordinal: function(num){
            switch (num % 10){
                case 1:
                    return num + 'st';
                    break;
                case 2:
                    return num + 'nd';
                    break;
                case 3:
                    return num + 'rd';
                    break;
                default:
                    return num + 'th';
                    break;
            }
        },
        loadYears: function(){
            var vm = this;
            this.$http.get('/api/years').then(function(d){
                vm.years = JSON.parse(d.body);
                vm.months = [];
                vm.days = [];
                vm.games = [];
            },function(d){
                alert('error');
            });
        },
        selectYear: function(y){
            this.selected.year = y;
            this.loadMonths(y);
        },
        loadMonths: function(y){
            var vm = this;
            this.$http.get('/api/months/' + y).then(function(d){
                vm.months = JSON.parse(d.body);
                vm.days = [];
                vm.games = [];
            },function(d){
                alert('error');
            });
        },
        selectMonth: function(m){
            this.selected.month = m;
            this.loadDays(this.selected.year, m);
        },
        loadDays: function(y, m){
            var vm = this;
            this.$http.get('/api/days/' + y + '/' + m).then(function(d){
                vm.days = JSON.parse(d.body);
                vm.games = [];
            },function(d){
                alert('error');
            });
        },
        selectDay: function(d){
            this.selected.day = d;
            this.loadGames(this.selected.year, this.selected.month, d);
        },
        loadGames: function(y, m, d){
            var vm = this;
            this.$http.get('/api/games/' + y + '/' + m + '/' + d).then(function(data){
                vm.games = JSON.parse(data.body);
            },function(d){
                alert('error');
            });
        },
        selectGame: function(g){
            this.loadGame(g.game_id);
            this.loadInning(g.game_id, 1);
        },
        loadGame: function(g){
            var vm = this;
            this.$http.get('/api/game/' + g).then(function(data){
                vm.selected.game = JSON.parse(data.body);
            },function(d){
                alert('error');
            });
        },
        selectInning: function(i){
            this.selected.inning.inning = i;
            this.loadInning(this.selected.game.game_id, i);
        },
        loadInning: function(g, i){
            this.unselectPlateAppearance;
            var vm = this;
            vm.selected.inning.plate_appearances = [];
            this.$http.get('/api/game/' + g + '/inning/' + i).then(function(data){
                vm.selected.inning.plate_appearances = JSON.parse(data.body);
            },function(d){
                alert('error');
            });
        },
        selectPlateAppearance: function(pa){
            this.selected.plate_appearance.pa_number = pa;
            this.loadPlateAppearance(this.selected.game.game_id, pa);
        },
        loadPlateAppearance: function(g, pa){
            var vm = this;
            vm.selected.plate_appearance.pitches = [];
            this.$http.get('/api/game/' + g + '/pa/' + pa).then(function(data){
                var ret = JSON.parse(data.body);
                vm.selected.plate_appearance.pitches = ret.pitches;
                vm.selected.plate_appearance.pfx_pitches = ret.pfx;
                vm.selected.plate_appearance.stats_pitches = ret.stats;
            },function(d){
                alert('error');
            });
        },
        unselectPlateAppearance: function(){
            this.selected.plate_appearance = {
                    pa_number: 0,
                    pitches:[],
                    pfx_pitches:[],
                    stats_pitches:[],
                };
        }
    }
});

new Vue({
    el: 'body'
});