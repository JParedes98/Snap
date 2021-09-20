export default {
    user: JSON.parse(localStorage.getItem('user')) || null,
    token: localStorage.getItem('jwt_token') || '',
    token_expiration: localStorage.getItem('token_expiration') || '',
}
