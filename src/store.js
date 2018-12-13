import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
import createLogger from 'vuex/dist/logger';
import createPersistedState from 'vuex-persistedstate';
import config from './config';

Vue.use(Vuex);

export default new Vuex.Store({
  plugins: [
    createLogger(),
    createPersistedState(),
  ],
  state: {
    server: {
      under_attack: false,
      ddos: 0,
      score: 0,
      teamname: 'Team Name',
      alive_web: true,
      alive_erp: true,
      alive_sslvpn: true,
      alive_level: 3,
      bandwidth: 0,
      energy: 0,
      wifi: 0,
    },
    vtime: {
      day: 0,
      hour: 0,
    },
    teamId: '1',
    apiErrorCount: 0,
    prevBandwidth: 0,
  },
  mutations: {
    SET_LOCAL_DATA: (state, server) => {
      state.server = server;
      console.log(
        'bandwidth',
        server.bandwidth,
        'energy',
        server.energy,
        'wifi',
        server.wifi,
      );
    },
    SET_TEAM_ID: (state, teamId) => {
      state.teamId = teamId;
    },
    SET_VTIME: (state, vtime) => {
      state.vtime = vtime;
    },
    INCREASE_API_ERROR_TIME: (state) => {
      state.apiErrorCount += 1;
    },
    RESET_API_ERROR_TIME: (state) => {
      state.apiErrorCount = 0;
    },
    MINUS_PREV_BANDWIDTH: (state) => {
      const prevBandwidth = state.server.bandwidth;
      console.log('prevBandwidth', state.prevBandwidth);
      console.log('currentBandwidth', state.server.bandwidth);
      state.server.bandwidth -= state.prevBandwidth;
      console.log('minus', state.server.bandwidth);
      state.server.bandwidth /= (config.fetchInterval / 2 / 1000);
      console.log('result', state.server.bandwidth);
      state.prevBandwidth = prevBandwidth;
    },
  },
  actions: {
    setTeamId({ commit }, teamId) {
      commit('SET_TEAM_ID', teamId);
    },
    fetchServerData({ commit }, teamId) {
      axios.post(`${config.baseURL}${config.teamPath}?team_id=${teamId}`, {
        team_id: teamId,
      }).then((resp) => {
        resp.data.alive_level = resp.data.alive_web
          + resp.data.alive_erp
          + resp.data.alive_sslvpn;
        commit('SET_LOCAL_DATA', resp.data);
        commit('RESET_API_ERROR_TIME');
        commit('MINUS_PREV_BANDWIDTH');
        return Promise.resolve(resp.data);
      }).catch((err) => {
        commit('INCREASE_API_ERROR_TIME');
        return Promise.reject(err);
      });
    },
    fetchVTime({ commit }) {
      axios.get(`${config.baseURLVTime}${config.vtimePath}`).then((resp) => {
        commit('SET_VTIME', resp.data);
        return Promise.resolve(resp.data);
      }).catch((err) => {
        console.error(err);
        return Promise.reject(err);
      });
    },
  },
});
