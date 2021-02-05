import Home from './pages/Home.vue';
import Deposit from './pages/Deposit.vue';
import Support from './pages/Support.vue';
import SupportShow from './pages/Support.vue';
import Withdraw from './pages/Withdraw.vue';
import Mixes from './pages/Mixes.vue';
import MixItem from './pages/MixItem.vue';
import UserProfile from './pages/UserProfile.vue';
import Referral from './pages/Referral.vue';
import Report from './pages/Report.vue';
import Competitions from './pages/Competitions.vue';
import CompetitionItem from './pages/CompetitionItem.vue';
import CompetitionRating from './pages/CompetitionRating.vue';
import CompetitionRules from './pages/CompetitionRules.vue';
import CompetitionPartners from './pages/CompetitionPartners.vue';

export const routes = [
    { path: '/', component: Home, name: 'Home' },
    { path: '/support', component: Support, name: 'Support' },
    { path: '/support/:id', component: SupportShow, name: 'SupportShow' },
    { path: '/items/deposit', component: Deposit, name: 'Deposit' },
    { path: '/items/withdraw', component: Withdraw, name: 'Withdraw' },
    { path: '/mix/list', component: Mixes, name: 'Mixes' },
    { path: '/user/:id', component: UserProfile, name: 'UserProfile' },
    { path: '/mix/:id', component: MixItem, name: 'MixItem' },
    { path: '/referral', component: Referral, name: 'Referral' },
    { path: '/report', component: Report, name: 'Report' },
    { path: '/competition', component: Competitions, name: 'Competitions' },
	{ path: '/competition/partners', component: CompetitionPartners, name: 'CompetitionPartners' },
    { path: '/competition/:short_name', component: CompetitionItem, name: 'CompetitionItem' },
    { path: '/competition/:short_name/rating', component: CompetitionRating, name: 'CompetitionRating' },
    { path: '/competition/:short_name/rules', component: CompetitionRules, name: 'CompetitionRules' },
];
