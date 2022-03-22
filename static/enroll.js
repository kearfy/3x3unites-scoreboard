import { Rable } from '../../../pb-pubfiles/js/rable.js';

const app = new Rable({
    data: {

        tournament1: payload.tournament1,
        tournament2: payload.tournament2,
        teamregistration: payload.teamregistration,
        teamregistrationEnabled: payload.teamregistrationEnabled,

        errorMessage: '',

        newplayername: '',
        newplayerage: '',
        newplayerheight: '',

        availableplayers: [],
        suggestedplayers: [],
        players: [],

        prefillPlayer() {
            this.errorMessage = '';
            var suggestions = [];
            if (this.newplayername !== '') this.availableplayers.forEach(p => {
                if (suggestions.length < 3 && p.name.toLowerCase().normalize('NFD').replace(/\p{Diacritic}/gu, "").includes(this.newplayername.toLowerCase().normalize('NFD').replace(/\p{Diacritic}/gu, ""))) {
                    suggestions.push(p);
                }
            });

            this.suggestedplayers = suggestions;
            if (suggestions.length > 0) {
                this.openSuggestions();
            } else {
                this.closeSuggestions();
            }
        },

        deletePlayer(index) {
            this.errorMessage = '';
            this.players.splice(index, 1);
        },

        addPlayer(index) {
            this.errorMessage = '';
            if (this.players.length < 3) {
                if (index) {
                    this.players.push({...this.suggestedplayers[index]});
                } else {
                    if (this.newplayername == '') return this.errorMessage = "Speler heeft geen naam!";
                    if (this.newplayerheight == '') return this.errorMessage = "Speler heeft geen lengte!";
                    if (this.newplayerage == '') return this.errorMessage = "Speler heeft geen leeftijd!";

                    this.players.push({
                        name: this.newplayername,
                        height: this.newplayerheight,
                        age: this.newplayerage
                    });
                }

                this.newplayername = this.newplayerheight = this.newplayerage = '';
                this.suggestedplayers = [];
                this.closeSuggestions();
            } else {
                this.errorMessage = "Je kunt maximaal 4 spelers toevoegen.";
            }
        },

        openSuggestions() {
            document.querySelector('.add-player .expandable-input').classList.remove('closed');
        },

        closeSuggestions(event) {
            document.querySelector('.add-player .expandable-input').classList.add('closed');
        },

        submitForm(e) {
            e.preventDefault();
        },

        finish() {
            const data = new FormData(document.querySelector('form'));

            if (this.tournament2 && this.teamregistration) {
                if (this.players.length < 1) {
                    this.errorMessage = 'Er moeten minstens 2 spelers in een team zitten.'
                    return;
                }

                this.players.forEach((player, index) => {
                    let prefix = 'player' + (index + 2) + '-';
                    data.set(prefix + 'name', player.name);
                    data.set(prefix + 'height', player.height);
                    data.set(prefix + 'age', player.age);
                });
            }

            fetch(location.href, {
                method: 'post',
                body: data
            }).then(res => res.json()).then(res => {
                if (res.success) {
                    location.href = '/';
                } else {
                    alert("Error: " + res.message + " (" + res.error + ")");
                }
            });
        }
    }
});

app.mount('body');

fetch('/api/players-suggestions').then(res => res.json()).then(res => app.data.availableplayers = res);
if (payload.teamregistration) fetch('/api/team/' + payload.team).then(res => res.json()).then(res => app.data.players = res.slice(1));