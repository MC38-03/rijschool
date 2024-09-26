import axios from 'axios';

const api = axios.create({
  baseURL: 'http://127.0.0.1:8000',
  withCredentials: true,
});

api.interceptors.request.use(async (config) => {
  if (!document.cookie.includes('XSRF-TOKEN')) {
    await api.get('/sanctum/csrf-cookie');
  }
  return config;
});

export default api;
