import Vue from 'vue'
import Vuex from 'vuex'
import Axios from 'axios'

Vue.use(Vuex)

const store = new Vuex.Store({
	state: {
		apiUrl: 'api/business',
		cart:[],
	},
	mutations: {
		setApiUrl: function(state, category) {
			state.apiUrl = `api/business/category/${category}`
		},
		resetApiUrl: function(state) {
			state.apiUrl = 'api/business'
		},
		addBag(state,items){
			state.cart.push(items);
		}
	},

	actions: {
		setApiUrl (context) {
			context.commit('setApiUrl')
		}
	}
})

export default store
