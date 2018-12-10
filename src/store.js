import Vue from 'vue';
import Vuex from 'vuex';
import axios from './axios';
import config from './config';

Vue.use(Vuex);

export default new Vuex.Store({
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
      bandwith: 0,
      energy: 0,
      wifi: 0,
    },
    teamId: 'T1',
  },
  mutations: {
    SET_LOCAL_DATA: (state, server) => {
      state.server = server;
    },
    SET_TEAM_ID: (state, teamId) => {
      state.teamId = teamId;
    },
  },
  actions: {
    setTeamId({ commit }, teamId) {
      commit('SET_TEAM_ID', teamId);
    },
    fetchServerData({ commit }, teamId) {
      axios.get(config.teamPath, {
        params: {
          team_id: teamId,
        },
      }).then((resp) => {
        resp.data.alive_level = resp.data.alive_web
          + resp.data.alive_erp
          + resp.data.alive_sslvpn;
        commit('SET_LOCAL_DATA', resp.data);
        return Promise.resolve(resp.data);
      }).catch(err => Promise.reject(err));
    },
  },
});
