/* -----------------------------------------
* HANDLE ADDRESS GEOCODE
-------------------------------------------*/

//*** FUNCTIONS ***//
const fetchApi = query => {

    // Geocode API Call
    axios.get(baseUri + query + '.json', {
        params: baseParams,
        transformRequest: sanitizeHeaders
    })
        .then(res => {

            console.log(res.data.results);

        })
        .catch(err => {
            console.log(err);
        });
}

//*** INIT ***//
// dom
const addressInput = document.getElementById('address');

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


//*** LOGIC ***//
addressInput.addEventListener('keyup', () => {

    // Get Input Value
    const addressTerm = addressInput.value.trim();

    // Fetch TT API
    fetchApi(addressTerm);
});