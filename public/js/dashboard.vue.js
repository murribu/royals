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
                },
                discrepancy: {
                    pitch_id: '',
                    column_name: '',
                    truth: '',
                    pfx: '',
                    stats: '',
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
        },
        discrepancyIsSelected: function(){
            return this.selected.discrepancy.column_name != '';   
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
            this.unselectPlateAppearance();
            this.selected.inning.inning = i;
            this.loadInning(this.selected.game.game_id, i);
        },
        loadInning: function(g, i){
            var vm = this;
            this.$http.get('/api/game/' + g + '/inning/' + i).then(function(data){
                vm.selected.inning.plate_appearances = JSON.parse(data.body);
            },function(d){
                alert('error');
            });
        },
        selectPlateAppearance: function(pa){
            this.selected.plate_appearance.pa_number = pa;
            this.unselectDiscrepancy();
            this.loadPlateAppearance(this.selected.game.game_id, pa);
        },
        loadPlateAppearance: function(g, pa){
            var vm = this;
            this.$http.get('/api/game/' + g + '/pa/' + pa).then(function(data){
                var ret = JSON.parse(data.body);
                for (p in ret.pfx){
                    ret.pfx[p].discrepancies = {};
                    if (ret.pfx[p].discrepancies_str){
                        for (d in ret.pfx[p].discrepancies_str.split(',')){
                            ret.pfx[p].discrepancies[ret.pfx[p].discrepancies_str.split(',')[d]] = true;
                        }
                    }
                }
                for (p in ret.stats){
                    ret.stats[p].discrepancies = {};
                    if (ret.stats[p].discrepancies_str){
                        for (d in ret.stats[p].discrepancies_str.split(',')){
                            ret.stats[p].discrepancies[ret.stats[p].discrepancies_str.split(',')[d]] = true;
                        }
                    }
                }
                vm.selected.plate_appearance.pitches = ret.pitches;
                vm.selected.plate_appearance.pfx_pitches = ret.pfx;
                vm.selected.plate_appearance.stats_pitches = ret.stats;
            },function(d){
                alert('error');
            });
        },
        selectDiscrepancy: function(pitch, column_name){
            if (pitch.discrepancies[column_name]){
                this.loadDiscrepancy(pitch.pitch_id, column_name);
            }
        },
        loadDiscrepancy: function(pitch_id, column_name){
            this.unselectDiscrepancy();
            var vm = this;
            this.$http.get('/api/discrepancy/' + pitch_id + '/' + column_name).then(function(data){
                vm.selected.discrepancy = JSON.parse(data.body);
                vm.selected.discrepancy.column_name = column_name;
                vm.selected.discrepancy.pitch_id = pitch_id;
            },function(d){
                alert('error');
            });
        },
        chooseSource: function(source){
            var vm = this;
            var sent = {
                _token: token,
                source: source
            };
            this.$http.post('/api/discrepancy/' + this.selected.discrepancy.pitch_id + '/' + this.selected.discrepancy.column_name, sent).then(function(data){
                this.loadPlateAppearance(this.selected.game.game_id, this.selected.plate_appearance.pa_number);
                this.loadDiscrepancy(this.selected.discrepancy.pitch_id, this.selected.discrepancy.column_name);
            },function(d){
                alert('error');
            });
        },
        resolveDiscrepancy: function(){
            var vm = this;
            var sent = {
                _token: token
            };
            var pitch_id = this.selected.discrepancy.pitch_id;
            var column_name = this.selected.discrepancy.column_name;
            this.unselectDiscrepancy();
            this.$http.post('/api/discrepancy/' + pitch_id + '/' + column_name + '/resolve', sent).then(function(data){
                this.loadInning(this.selected.game.game_id, this.selected.inning.inning);
                this.loadPlateAppearance(this.selected.game.game_id, this.selected.plate_appearance.pa_number);
                this.loadGame(this.selected.game.game_id);
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
        },
        unselectDiscrepancy: function(){
            this.selected.discrepancy = {
                pitch_id: '',
                column_name: '',
                truth: '',
                pfx: '',
                stats: '',
            };
        }
    }
});

new Vue({
    el: 'body'
});