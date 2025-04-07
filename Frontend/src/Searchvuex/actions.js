import { http } from '@/utils/http';

export default {
  async searchBooks({ commit }, searchTerm) {
    if (!searchTerm || searchTerm.trim().length === 0) {
      commit('setSearchResults', []);
      return;
    }

    commit('setLoading', true);
    commit('setError', null);
    commit('setSearchTerm', searchTerm);

    try {
      const response = await http.get(`/books/search/${encodeURIComponent(searchTerm)}`);
      commit('setSearchResults', response.data.data);
    } catch (error) {
      console.error('Hiba a könyvek keresése közben:', error);
      commit('setError', 'Nem sikerült betölteni a keresési eredményeket');
      commit('setSearchResults', []);
    } finally {
      commit('setLoading', false);
    }
  },

  clearSearch({ commit }) {
    commit('setSearchResults', []);
    commit('setSearchTerm', '');
  }
};