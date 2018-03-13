import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    userInfo: {
      nicName: 'JACK',
      id: 11,
      unReadMsgCount: 0
    }
  },
  mutations: {
    incrUnReadMsg (state) {
      this.userInfo.unReadMsgCount++
    }
  },
  actions: {
    incrUnReadMsg ({ commit }) {
      commit('incrUnReadMsg')
    }
  }

})
