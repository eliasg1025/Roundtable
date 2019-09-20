export default {
	state: {
		apiUrl: 'api/business'
	},
	mutations: {
		modifyUrl(state, category) {
			state.apiUrl = `api/business/${category}`
		}
	}
}
