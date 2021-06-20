import axios from 'axios';
export let API_URL;

// checking if development or production
if (!process.env.NODE_ENV || process.env.NODE_ENV === "development") {
  // development
  // development
  API_URL = 'http://localhost:8090/orionis/api';
} else {
  // production
}

export const getCustomers = async () => {
  const result = await axios(`${API_URL}\\customers`);
  return result.data;
};
