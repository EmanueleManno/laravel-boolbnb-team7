/* -----------------------------------------
* HANDLE ADDRESS GEOCODE
-------------------------------------------*/

//*** FUNCTIONS ***//
const searchPlace = addressTerm => {

    // Handle API throttling
    clearTimeout(timeoutId);
    timeoutId = setTimeout(() => {
        fetchApi(addressTerm);
    }, 500);
}

const fetchApi = query => {

    // Resets
    suggestionsElem.innerHTML = '';

    // Check query param
    if (!query) return;

    // Geocode API Call
    axios.get(baseUri + query + '.json', {
        params: baseParams,
        transformRequest: sanitizeHeaders
    })
        .then(res => {

            const { results } = res.data;
            console.log(results);
            if (!results.length) return;

            // Update data
            results.forEach(result => {

                // Create suggestions
                suggestionsElem.innerHTML += `<option value="${result.address.freeformAddress}"></option>`;
            });

        })
        .catch(err => {
            console.log(err);
        });
}

//*** INIT ***//
// dom
const addressInput = document.getElementById('address');
const suggestionsElem = document.getElementById('api-suggestions');

// api
const baseUri = 'https://api.tomtom.com/search/2/geocode/';
const baseParams = {
    key: import.meta.env.VITE_TT_API_KEY,
    limit: 5,
    language: 'it-IT',
    countrySet: 'IT'
};
const sanitizeHeaders = [(data, headers) => {
    delete headers.common["X-Requested-With"];
    return data
}];

// variables
let timeoutId = null;


//*** LOGIC ***//
addressInput.addEventListener('keyup', () => {

    // Get Input Value
    const addressTerm = addressInput.value.trim();

    // Fetch TT API with throttling
    searchPlace(addressTerm);
});