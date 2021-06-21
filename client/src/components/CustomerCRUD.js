import { useEffect, useState } from 'react';
import PropTypes from 'prop-types';
import Jumbotron from 'react-bootstrap/Jumbotron';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Spinner from 'react-bootstrap/Spinner';
import CustomerForm from './CustomerForm';
import AddressForm from './AddressForm';
import * as APIUtils from '../api/APIUtils';
import Datatable from 'react-data-table-component';

function CustomerCRUD(props) {
  const [customersData, setCustomersData] = useState([]);
  const [countriesData, setCountriesData] = useState([]);
  const [statesData, setStatesData] = useState([]);  
  const [isLoading, setIsLoading] = useState(false);

  const [customerForm, setCustomerForm] = useState({
    firstname: '',
    lastname: '',
    email: '',
    phone: '',
    birthdate: new Date(),
    gender: ''
  });

  const [addressForm, setAddressForm] = useState({
    addressLine1: '',
    addressLine2: '',
    countryId: 230,
    stateId: '',
    city: '',
    zipcode: ''
  });

  const [isError, setIsError] = useState(false);

  useEffect(() => {
    const fetchData = async () => {
      setIsError(false);
      setIsLoading(true);
      try {
        const customersResult = await APIUtils.getCustomers();
        const countriesResult = await APIUtils.getCountries();
        setCustomersData(customersResult.data);
        setCountriesData(countriesResult.data);
      } catch (error) {
        setIsError(true);
      }
      setIsLoading(false);
    };

    fetchData();
  }, []);

  useEffect(() => {
    const fetchData = async () => {
      const statesResult = await APIUtils.getStatesByCountryId(addressForm.countryId);
      setStatesData(statesResult.data);
    };

    fetchData();
  }, [addressForm.countryId]);
  

  function handleCustomerFormInputChange(event) {
    const target = event.target;
    const value = target.type === 'checkbox' ? target.checked : target.value;
    const name = target.name;

    setCustomerForm(prevState => ({...prevState, [name] : value}));
  }

  function handleAddressFormInputChange(e) {
    setAddressForm(prevState => ({...prevState, [e.target.name] : e.target.value}));
  }

  function handleCustomerFormDateInputChange(date, name) {
    setCustomerForm(prevState => ({...prevState, [name] : date}));
  }

  function handleAddressFormSubmit() {
    console.log('address form submit!');
  }

  function handleCustomerFormSubmit() {
    console.log('customer submit!');
  }

  const customerDatatableColumns = [
    {
      name: 'firstname',
      selector: 'firstname',
      sortable: true
    },
    {
      name: 'lastname',
      selector: 'lastname',
      sortable: true
    },
    {
      name: 'email',
      selector: 'email',
      sortable: true
    },
    {
      name: 'phone',
      selector: 'phone',
      sortable: true
    },
    {
      name: 'birthdate',
      selector: 'birthdate',
      sortable: true
    },
    {
      name: 'gender',
      selector: 'gender',
      sortable: true
    },
  ];

  // const data = [{ id: 1, title: 'Conan the Barbarian', year: '1982'},  { id: 1, title: 'War of Somalia', year: '1982'}];
  // const columns = [
  //   {
  //     name: 'Title',
  //     selector: 'title',
  //     sortable: true,
  //   },
  //   {
  //     name: 'Year',
  //     selector: 'year',
  //     sortable: true,
  //   },
  // ];

  return (
    <>
      {isLoading
        ? <Spinner animation="border" />
        :
        <>
          <CustomerForm 
            formValues={customerForm} 
            onSubmitClick={handleCustomerFormSubmit}
            onInputChange={handleCustomerFormInputChange} 
            onDateInputChange={handleCustomerFormDateInputChange} 
          />

          <AddressForm 
            formValues={addressForm}
            onSubmitClick={handleAddressFormSubmit}
            onInputChange={handleAddressFormInputChange}
            countries={countriesData}
            states={statesData}
          />

          <Datatable 
            title="Customers"
            columns={customerDatatableColumns}
            data={customersData}
          />
          
        </>
      } 

      {isError && <div>Something went wrong ...</div>}
    </>
  );
}

export default CustomerCRUD;

CustomerCRUD.propTypes = {};
