document.addEventListener("DOMContentLoaded", function () {

    var Socket = new WebSocket('wss://api-pub.bitfinex.com/ws/2');
    var IsConnected = false;
    // Listen for messages
    Socket.addEventListener('message', (msg) => {
        axios({
            method: "get",
            url: `/refresh/ws/t${document.getElementsByName('name')[0].value}`,
            contentType: 'application/json'
        })
            .then(function (response) {

                const data = response.data;
                let r = `
                        <tr class="hover:bg-grey-lighter" >
                                <td class="py-4 px-6 border-b border-grey-light"> ${data[0][0].substring(1, data[0][0].length)}</td>
                                <td class="py-4 px-6 border-b border-grey-light">${data[0][1]}
                                </td>
                                <td class="py-4 px-6 border-b border-grey-light">${data[0][2]}
                                </td>
                                <td class="py-4 px-6 border-b border-grey-light"> ${(data[0][6] * 100).toFixed(3)}%
                                </td>
                                <td class="py-4 px-6 border-b border-grey-light">${data[0][9]}
                                </td>
                                <td class="py-4 px-6 border-b border-grey-light">${data[0][10]}
                                </td>
                        </tr>`;

                document.getElementById('list').innerHTML = r;
            })
            .catch(function (error) {
                console.log(error);
            })
    });

    let msg =  {
        event: 'subscribe',
        channel: 'ticker',
        symbol: 'tBTCUSD'
    };

    let symbols = ['tBTCUSD','tETHUSD','tLTCUSD','tLTCBTC','tETHBTC'];

    // Connection opened
    Socket.addEventListener('open', () => {
        Socket.send(JSON.stringify(msg));
        IsConnected = true;
    });

    CheckSocketConnectionCallback = () => {
        if (IsConnected) {
            clearInterval(CheckSocketConnection);
            SocketConnectedCallBack();
        }
    }

    SocketConnectedCallBack = () => {
        symbols.forEach((element) => {
            msg.symbol = element;
            Socket.send(JSON.stringify(msg));
        });
    }

    var CheckSocketConnection = setInterval(CheckSocketConnectionCallback, 1000);
});
