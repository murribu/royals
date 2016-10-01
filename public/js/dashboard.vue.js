Vue.component('dashboard',{
    template: '#dashboard-template',
    data: function(){
        return {
            selected: {
                year: '',
                month: '',
                day: '',
                game: '',
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
    methods: {
        loadYears: function(){
            var vm = this;
            this.$http.get('/api/years').then(function(d){
                vm.years = JSON.parse(d.body);
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
            this.selected.game = g.id;
        }
    }
});

new Vue({
    el: 'body'
});