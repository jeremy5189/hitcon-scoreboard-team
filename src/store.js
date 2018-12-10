import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    server: {},
    teamId: null,
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
  },
});
