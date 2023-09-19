import * as storage from "../utils/storage";

/**
 * Get access token from storage.
 *
 * @returns {string}
 */

export function getAccessToken() {
    return storage.get('access-token');
}

/**
 * Set access token to storage.
 *
 * @param {string} accessToken
 */
export function setAccessToken(accessToken) {
    storage.set('access-token', accessToken);
}

/**
 * Get Auth Detail from storage.
 *
 * @returns {string}
 */
export function getAuthDetail() {
    return storage.get('Auth-Detail');
}

/**
 * Set Auth Detail to storage.
 *
 * @param {string} AuthDetail
 * @returns {string}
 */
export function setAuthDetail(AuthDetail) {
    return storage.set('Auth-Detail', AuthDetail);
}

/**
 * Clear tokens.
 */
export function clear() {
    storage.clear();
}