<section class="page-introduction">
    <h1>
        Tournament administratie
    </h1>
    <p>
        Beheer spelers en het tournament.
    </p>
</section>

<section class="transparent no-margin overflow-scroll">
    <table>
        <thead>
            <tr>
                <th>
                    Team owner
                </th>
                <th>
                    Team
                </th>
                <th>
                    Acties
                </th>
            </tr>
        </thead>
        <tbody>
            <tr :for="teams as team => players">
                <td>
                    {{ players[0].name }}
                </td>
                <td>
                    {{ team }}
                </td>
                <td>
                    <a :bind:href="'/team/' + team">
                        View team
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</section>

<section class="transparent no-margin overflow-scroll">
    <table>
        <thead>
            <tr>
                <th class="smaller">ID</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            <tr :for="player in players">
                <td>
                    {{ player.id }}
                </td>
                <td>
                    {{ player.firstname }} {{ player.lastname }}
                </td>
                <td>
                    {{ player.email }}
                </td>
                <td>
                    {{ player.created }}
                </td>
                <td>
                    {{ player.updated }}
                </td>
                <td>
                    <a :bind:href="'/profile/' + player.id">
                        View
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</section>