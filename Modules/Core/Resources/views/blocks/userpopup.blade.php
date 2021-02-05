{{-- <profile-popup v-bind:user="player" :user_close="closeUser"></profile-popup> --}}
<div class="user_profile" v-bind:class="{'admin_users': creator, 'normal_users': !creator}" id="user_popup" v-if="player">
        {{-- <a class="user_close"></a> --}}

        <div class="head" v-if="creator">
            <div class="title">ПЕРЕМЕСТИТЬ В ДРУГУЮ КОМАНДУ <a href="/" v-on:click="moveMethod(player.user_id, $event)"></a></div>
            <div class="links">
                <a href="/" v-on:click="kickMethod(player.user_id, $event)">Кикнуть игрока</a>
                {{-- <a href="#">Добавить в блоклист</a> --}}
            </div>
        </div>

        <div class="top">
            <div class="user_avatar">
                <div class="avatar" v-if="player"><img :src="player.user.avatar_medium"></div>
                <div class="skill rank" v-bind:class="['rank_' + player.user.own_rank]" v-if="player">@{{player.user.own_rank}}</div>
            </div>
            <div class="user_name" v-if="player">@{{player.user.name}}</div>
        </div>

        <div class="bot">
            <div class="item">
                <div class="img"><img src="/images/user/ico-1.png" v-if="player"></div>
                <div class="text" v-if="player">@{{(!player.user.deaths || player.user.deaths == 0) ? "1.00" : (Math.round((player.user.kills/player.user.deaths)*100)/100).toFixed(2)}}</div>
            </div>
            <div class="item">
                <div class="img" v-if="player"><img src="/images/user/ico-2.png" v-if="player"></div>
                <div class="text" v-if="player">@{{(!player.user.games || player.user.games == 0) ? 100 : Math.round((player.user.wins/player.user.games) * 100)}}%</div>
            </div>
            <div class="item">
                <div class="img" v-if="player"><img src="/images/user/ico-3.png" v-if="player"></div>
                <div class="text" v-if="player">@{{(!player.user.kills || player.user.kills == 0) ? 100 : Math.round((player.user.headshot_kills/player.user.kills)*100)}}%</div>
            </div>
            <div class="item">
                <div class="img" v-if="player"><img src="/images/user/ico-4.png" v-if="player"></div>
                <div class="text" v-if="player">@{{player.user.kills ? player.user.kills : 0}}</div>
            </div>
        </div>

        <a :href="'/user/' + player.user.id" target="_blank" class="user_btn" v-if="player">СМОТРЕТЬ ПРОФИЛЬ</a>
    </div>
