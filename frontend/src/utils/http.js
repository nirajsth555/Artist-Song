import axios from "axios";
import config from "../config";
import * as tokenService from "../services/token";

const AUTHORIZATION_HEADER = 'Authorization';

const http = axios.create({
    baseURL: config.apiBaseURI,
    headers: {
        'Content-Type': 'application/json'
    }
});

function buildAuthHeader(accessToken) {
    return `Bearer ${accessToken}`;
}

http.interceptors.request.use(
    (request) => {
        const accessToken = tokenService.getAccessToken();
        if (accessToken) {
            request.headers[AUTHORIZATION_HEADER] = buildAuthHeader(accessToken);
        };
        return request
    },
    (requestError) => {
        throw requestError;
    }
)

export default http;