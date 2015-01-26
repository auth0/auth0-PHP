# CHANGELOG

## 0.6.6

- Internal change, instead of using inheritance to change how we persist user data we now use composition
- API change, now getUserInfo returns the user info directly, so if you want the user name you use $userInfo['name'] instead of $userInfo['results']['name']

## 0.6.5

- Added fitbit example
- Fix base url bug
