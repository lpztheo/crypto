/*fetch('https://sandbox-api.coinmarketcap.com/v1/cryptocurrency/listings/latest')
.then(res =>console.log(res))*/

const apikey = {
  key: '0a1b7ccf-02cb-4010-8423-e744d4491a81'
}

const proxy = 'https://cors-anywhere.herokuapp.com/';
request('GET','https://sandbox-api.coinmarketcap.com/v1/cryptocurrency/listings/latest?start=1&limit=10&convert=USD&CMC_PRO_API_KEY=' + apikey.key)
.then((r1) => {
  let x1 = JSON.parse(r1.target.responseText);
  console.log(x1.data.quote.USD.total_market_cap);
}).catch(err => {
  console.log(err);
})  
  
function request(method, url) {
      return new Promise(function (resolve, reject) {
          var xhr = new XMLHttpRequest();
          xhr.open(method,url);
          xhr.setRequestHeader( 'Access-Control-Allow-Origin', '*');
          xhr.setRequestHeader( 'Content-Type', 'application/json' );
          xhr.onload = resolve;
          xhr.onerror = reject;
          xhr.send();
      });
}
/*alert('hello orld')*/



