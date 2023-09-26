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
    addressInput.value = '';

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

            // Update suggestions
            results.forEach(result => {
                // Create suggestions
                suggestionsElem.innerHTML += `<option value="${result.address.freeformAddress}"></option>`;
            });

            // Update address input (get only first result)
            addressInput.value = results[0].address.freeformAddress;

        })
        .catch(err => {
            console.log(err);
        });
}

//*** INIT ***//
// dom
const addressSearchInput = document.getElementById('address-search');
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
addressSearchInput.addEventListener('keyup', () => {

    // Get Input Value
    const addressTerm = addressSearchInput.value.trim();

    // Fetch TT API with throttling
    searchPlace(addressTerm);
});