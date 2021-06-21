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

export const getCustomerById = async (id) => {
  const result = await axios(`${API_URL}\\customers\\${id}`);
  return result.data;
};

export const addCustomer = async (data) => {
  const result = await axios.post(`${API_URL}\\customers`, {
    firstname: data.firstname,
    lastname: data.lastname,
    email: data.email,
    phone: data.phone,
    gender: data.gender,
    birthdate: data.birthdate.toISOString().split('T')[0]
  });

  return result.data;
}

export const editCustomer = async (data) => {
  const result = await axios.put(`${API_URL}\\customers\\${data.id}`, {
    firstname: data.firstname,
    lastname: data.lastname,
    email: data.email,
    phone: data.phone,
    gender: data.gender,
    birthdate: data.birthdate.toISOString().split('T')[0]
  });

  return result.data;
}

export const deleteCustomer = async (id) => {
  const result = await axios.delete(`${API_URL}\\customers\\${id}`);
  return result.status;
};

export const getCountries = async () => {
  const result  = await axios(`${API_URL}\\countries`);
  return result.data;
}

export const getStatesByCountryId = async (countryId) => {
  const result = await axios(`${API_URL}\\countries\\${countryId}\\states`);
  return result.data;
};
