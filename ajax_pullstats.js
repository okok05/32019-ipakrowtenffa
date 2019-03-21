request.get('https://pullstats.com/').auth('username', 'password', false);
// or
request.get('https://pullstats.com/', {
  'auth': {
    'user': 'nProMarket2',
    'pass': 'pullstats',
    'sendImmediately': false
  }
});
// or
request.get('https://pullstats.com/').auth(null, null, true, 'bearerToken');
// or
request.get('https://pullstats.com/', {
  'auth': {
    'bearer': 'bearerToken'
  }
});