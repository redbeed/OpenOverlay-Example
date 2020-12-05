export default class LatestEvent {
    constructor(twitchUserId) {
        this.twitchUserId = twitchUserId;
        this.container = document.getElementById('latest-event');
        this.titleElement = document.getElementById('latest-event-title');
        this.usernameElement = document.getElementById('latest-event-username');

        this.types = {
            'channel.follow': 'Latest Follower',
            'channel.subscribe': 'Latest Subscriber'
        };

        this.subscribeEcho();
    }

    subscribeEcho() {
        Echo.channel(`twitch.${ this.twitchUserId }`)
            .listen('.event-received', (eventData) => {
                console.log(eventData);
                if (eventData.type === 'channel.follow' || eventData.type === 'channel.subscribe') {
                    this.replaceUser(eventData);
                }
            });
    }

    replaceUser(eventData) {
        console.log('replace');
        this.titleElement.textContent = this.types[eventData.type] || 'Unkown';
        this.usernameElement.textContent = eventData.data.user_name;
    }
}
