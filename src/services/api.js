import axios from 'axios';

const api = axios.create({
  baseURL: 'http://127.0.0.1:8000/api',
  withCredentials: true,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  },
});

export const getCsrfToken = async () => {
  try {

    await axios.get('http://127.0.0.1:8000/sanctum/csrf-cookie', { withCredentials: true });

    const csrfCookie = document.cookie.split('; ').find(row => row.startsWith('XSRF-TOKEN='));
    
    if (csrfCookie) {
      const token = csrfCookie.split('=')[1];
      axios.defaults.headers.common['X-XSRF-TOKEN'] = decodeURIComponent(token);
    } else {
      console.error('CSRF token not found');
    }
  } catch (error) {
    console.error('Failed to get CSRF token', error);
  }
};



export default api;
