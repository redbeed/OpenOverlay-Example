export default class SteamHUD {
    constructor(twitchUserId) {
        this.twitchUserId = twitchUserId;
        this.container = document.getElementById('steam-hud');

        if(!this.container) return;

        this.titleElement = document.getElementById('steam-hud-title');
        this.usernameElement = document.getElementById('steam-hud-username');

        this.types = {
            'channel.follow': 'Latest Follower',
            'channel.subscribe': 'Latest Subscriber',
        };

        this.subscribeEcho();
    }

    subscribeEcho() {
        Echo.channel(`twitch.${ this.twitchUserId }`)
            .listen('.event-received', (eventData) => {
                if (eventData.type === 'channel.follow' || eventData.type === 'channel.subscribe') {
                    this.replaceUser(eventData);
                    console.log('POP');
                }
            });
    }

    replaceUser(eventData) {
        this.titleElement.textContent = this.types[eventData.type] || 'Unkown';
        this.usernameElement.textContent = eventData.data.user_name;
    }
}
