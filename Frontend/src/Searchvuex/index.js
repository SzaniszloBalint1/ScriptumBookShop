import mutations from './mutations';
import actions from './actions';
import getters from './getters';

export default {
  namespaced: true,
  state() {
    return {
      searchResults: [],
      isLoading: false,
      error: null,
      searchTerm: ''
    };
  },
  mutations,
  actions,
  getters
};
