import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const state = {
    transaction_id: '',
    employee_details:[]
}

const getters = {
    // getUser: state => {
        // return state.user
    // }
}

const mutations = {
    getTransactionId(state, id) {
        state.transaction_id = id
    },
    getEmployeeDetailsArray(state,array){
        state.employee_details = array
    }
}

const actions = {
    // setUser(context, data) {
        // context.commit('setUser', data)
    // }
}

export default new Vuex.Store ({
    state,
    getters,
    mutations,
    actions
})