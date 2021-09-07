
document.addEventListener("DOMContentLoaded", function () {

    var Socket = new WebSocket('wss://api-pub.bitfinex.com/ws/2');
    let symbols = ['tBTCUSD','tETHUSD','tLTCUSD','tLTCBTC','tETHBTC']

    Socket.addEventListener('message', (msg) => {
        axios({
            method: "get",
            url: '/refresh',
            contentType: 'application/json'
        })
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            })
    });
    Socket.addEventListener('open', () => {
        for (let i = 0; i < symbols.length; i++)
        {
            Socket.send(JSON.stringify({
                event: 'subscribe',
                channel: 'ticker',
                symbol: symbols[i]
            }));
        }
    });
});
