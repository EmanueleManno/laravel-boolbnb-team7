/* -----------------------------------------
* HANDLE ADDRESS GEOCODE
-------------------------------------------*/

//*** FUNCTIONS ***//

/**
 * Throttle API Request for address geocode
 * 
 * @param {String} addressTerm 
 */
const searchPlace = addressTerm => {

    // Activate loader on key press
    apiLoaderElem.classList.remove('d-none');

    // Handle API throttling
    clearTimeout(timeoutId);
    timeoutId = setTimeout(() => {
        fetchApi(addressTerm);
    }, 500);
}

/**
 * Fetch Tom Tom Geocode API
 * 
 * @param {String} query 
 */
const fetchApi = query => {

    // Resets
    suggestionsElem.innerHTML = '';
    addressInput.value = '';
    latInput.value = 0;
    lonInput.value = 0;

    // Abort if query is empty
    if (!query) {
        // Remove Loader
        apiLoaderElem.classList.add('d-none');

        return;
    }

    // Geocode API Call
    axios.get(baseUri + query + '.json', {
        params: baseParams,
        transformRequest: sanitizeHeaders
    })
        .then(res => {

            // Get Results
            const { results } = res.data;
            console.log(results);
            if (!results.length) return;

            // Create suggestions list
            results.forEach(result => {
                suggestionsElem.innerHTML += `<option value="${result.address.freeformAddress}"></option>`;
            });

            // Update inputs (get only first result)
            const chosenAddress = results[0];
            addressInput.value = chosenAddress.address.freeformAddress;
            latInput.value = chosenAddress.position.lat;
            lonInput.value = chosenAddress.position.lon;

        })
        .catch(err => {
            console.log(err);
        })
        .then(() => {
            // Remove Loader
            apiLoaderElem.classList.add('d-none');
        });
}


//*** INIT ***//
// dom
const addressSearchInput = document.getElementById('address-search');
const suggestionsElem = document.getElementById('api-suggestions');
const apiLoaderElem = document.getElementById('api-loader');
const addressInput = document.getElementById('address');
const latInput = document.getElementById('latitude');
const lonInput = document.getElementById('longitude');

// api
const baseUri = 'https://api.tomtom.com/search/2/geocode/';
const baseParams = {
    key: import.meta.env.VITE_TT_API_KEY,// API KEY
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

    // Fetch TT API with throttling (bypass "Too many requests" error)
    searchPlace(addressTerm);
});