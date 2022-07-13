import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    authUser : {}
  },
  mutations : {
    setAuthUser(state, payload) {
      state.authUser = payload;
    }
  },
  getters: {
    getAuthUser(state, getters) {
      return state.authUser
    }
  },
  plugins: [createPersistedState({paths: ['authUser']})]
})
