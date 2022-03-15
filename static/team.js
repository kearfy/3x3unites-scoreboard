import { Rable } from '../../../pb-pubfiles/js/rable.js';

const app = new Rable({
    data: {
        players: []
    }
});

app.mount('body');

if (payload.team !== '!0!') fetch('/api/team/' + payload.team).then(res => res.json()).then(res => app.data.players = res);