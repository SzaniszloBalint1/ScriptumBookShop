export default {
    setSearchResults(state, results) {
        state.searchResults = results;
      },
      setLoading(state, status) {
        state.isLoading = status;
      },
      setError(state, error) {
        state.error = error;
      },
      setSearchTerm(state, term) {
        state.searchTerm = term;
      }
  };