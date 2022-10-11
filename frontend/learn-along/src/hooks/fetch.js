import axios from 'axios';
let base_url = "http://127.0.0.1:8000/api/"
const Fetch = async (api_url, api_data, api_token = null) => {
    try {
        return await axios.post(
            base_url + api_url,
            api_data,
            {
                headers: {
                    'Authorization': api_token
                }
            }
        );
    } catch (error) {
        console.log("Error from POST API", error);
    }
};
export default Fetch