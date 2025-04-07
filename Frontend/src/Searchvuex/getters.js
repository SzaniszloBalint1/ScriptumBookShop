export default {
    searchResults(state) {
        return state.searchResults;
      },
      isLoading(state) {
        return state.isLoading;
      },
      hasError(state) {
        return state.error !== null;
      },
      errorMessage(state) {
        return state.error;
      },
      searchTerm(state) {
        return state.searchTerm;
      },
      hasResults(state) {
        return state.searchResults && state.searchResults.length > 0;
      }
  };