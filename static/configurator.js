import { Rable } from '../../../pb-pubfiles/js/rable.js';

const app = new Rable({
    data: {
        teams: [],
        players: [],
        stats: {}
    }
});

app.mount('.content');

fetch('/api/teams').then(res => res.json()).then(res => app.data.teams = res);
fetch('/api/players').then(res => res.json()).then(res => app.data.players = res);
fetch('/api/stats').then(res => res.json()).then(res => app.data.stats = res);