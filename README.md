# HITCON DEFENCE TEAM SCOREBOARD

![team-scoreboard](https://user-images.githubusercontent.com/1984426/50041337-3a996c00-008e-11e9-9d78-584111f36188.png)

(There is also [another dashboard](https://github.com/jeremy5189/hitcon-scoreboard) used to display all team status)

This is the team scoreboard of Hack In Taiwan Conference Defence, which took place on Dec. 14, 2018 in Taipei. Six major cooperation and governmental agency has participated in this event including:

- Ministry of Finance, Taiwan (財政部資安團隊）
- IISI Group (資拓宏宇)
- Chunghwa Telecom (中華電信聯隊)
- Industrial Technology Research Institute, Taiwan (工研院）
- And two other cooperation which remained anonymous

Participant of HITCON Defence will be given a set of enterprise level equipment including: Arbor APS, Amazon AWS, Cicso NGFW, Cicso switch, Dell rack server, Imperva WAF, Pulse Secure SSLVPN and Panduit Rack.

During the 6 hour contest, each team (blue team) shell utilize these equipment given above to defence against the red team. The red team will execute multiple attack trying to take down the blue team's service. The team who successfully kept their service up and live as long as possible will be the winner.

For more information please visit: [HITCON DEFENCE](https://hitcon.org/2018/defense/), [HITCON PACIFIC 2018](https://hitcon.org/2018/pacific/)

## Demo

![img_8091](https://user-images.githubusercontent.com/1984426/50041380-e2169e80-008e-11e9-8ca3-938b86b6d0c4.JPG)
![img_8109](https://user-images.githubusercontent.com/1984426/50041381-e2af3500-008e-11e9-901c-70b993a7f082.JPG)

- Demo Video 1: [https://youtu.be/qpa5Ibzpw48](https://youtu.be/qpa5Ibzpw48)
- Demo Video 2: [https://youtu.be/qpa5Ibzpw48](https://youtu.be/qpa5Ibzpw48)


## Project setup

```
npm install
```

### Compiles and hot-reloads for development

```
cp src/config.example.js src/config.js
npm run serve
npm run mock # Start mock server by php at localhost:8003
npm run mock-vtime # Start mock server by php at localhost:8004
```

### Compiles and minifies for production

```
cp src/config.example.js src/config.js
npm run build
```

### Lints and fixes files

```
npm run lint
```