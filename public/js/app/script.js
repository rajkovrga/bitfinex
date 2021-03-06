
document.addEventListener("DOMContentLoaded", function () {

    var Socket = new WebSocket('wss://api-pub.bitfinex.com/ws/2');
    var IsConnected = false;
    // Listen for messages
    let r = '/fav/';
    if(document.getElementsByName("types")[0])
    {
        r += document.getElementsByName("types")[0].value;
    }

    Socket.addEventListener('message', (msg) => {
        axios({
            method: "get",
            url: '/refresh' + r,
            contentType: 'application/json'
        })
            .then(function (response) {
                console.log(response.data);

                const data = response.data;
                let r = '';

                for(let i = 0; i < data.length;i++)
                {
                    r += `
                        <tr class="hover:bg-grey-lighter" >
                                <td class="py-4 px-6 border-b border-grey-light"><a href="/refresh/${data[i][0]}" class="underline">${data[i][0].substr(1, data[i][0].length)}</a></td>
                                <td class="py-4 px-6 border-b border-grey-light">${data[i][1]}
                                </td>
                                <td class="py-4 px-6 border-b border-grey-light">${data[i][2]}
                                </td>
                                <td class="py-4 px-6 border-b border-grey-light"> ${(data[i][6] * 100).toFixed(3)}%
                                </td>
                                <td class="py-4 px-6 border-b border-grey-light">${data[i][9]}
                                </td>
                                <td class="py-4 px-6 border-b border-grey-light">${data[i][10]}
                                </td>

                        </tr>

                        `;
                }
                document.getElementById('list').innerHTML = r;
            })
            .catch(function (error) {
                console.log(error);
            })    });

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
