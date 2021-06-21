import { useEffect, useState } from 'react';
import Proptypes from 'prop-types';
import Jumbotron from 'react-bootstrap/Jumbotron';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Spinner from 'react-bootstrap/Spinner';
import CustomerForm from './CustomerForm';
import * as APIUtils from '../api/APIUtils';
import Datatable from 'react-data-table-component';

function CustomerCRUD(props) {
  const [customersData, setCustomersData] = useState([]);
  const [isLoading, setIsLoading] = useState(false);
  const [customerForm, setCustomerForm] = useState({
    firstname: '',
    lastname: '',
    email: '',
    phone: '',
    birthdate: new Date(),
    gender: ''
  });
  const [isError, setIsError] = useState(false);

  useEffect(() => {
    const fetchData = async () => {
      setIsError(false);
      setIsLoading(true);
      try {
        const result = await APIUtils.getCustomers();
        setCustomersData(result);
        console.log(result);
      } catch (error) {
        setIsError(true);
      }
      setIsLoading(false);
    };

    fetchData();
  }, []);

  function handleCustomerFormInputChange(event) {
    const target = event.target;
    const value = target.type === 'checkbox' ? target.checked : target.value;
    const name = target.name;

    setCustomerForm(prevState => ({...prevState, [name] : value}));
  }

  function handleCustomerFormDateInputChange(date, name) {
    setCustomerForm(prevState => ({...prevState, [name] : date}));
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


  console.log(customersData);
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

CustomerCRUD.propType = {};
