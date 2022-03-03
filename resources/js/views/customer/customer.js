import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const state = {
    transaction_id: '',
    customer_details:[],
    customer_items:[]
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
    getCustomerDetailsArray(state,array){
        state.customer_details = array
    },
    getCustomerItems(state,array){
        state.customer_items = array
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