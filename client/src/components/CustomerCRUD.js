import { useEffect, useState } from 'react';
import Proptypes from 'prop-types';
import Jumbotron from 'react-bootstrap/Jumbotron';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Spinner from 'react-bootstrap/Spinner';
import CustomerForm from './CustomerForm';
import * as APIUtils from '../api/APIUtils';

function CustomerCRUD(props) {
  const [data, setData] = useState([]);
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

  return (
    <>
      {isLoading
        ? <Spinner animation="border" />
        :
        <CustomerForm 
          formValues={customerForm} 
          onSubmitClick={handleCustomerFormSubmit}
          onInputChange={handleCustomerFormInputChange} 
          onDateInputChange={handleCustomerFormDateInputChange} 

        />
      } 

      {isError && <div>Something went wrong ...</div>}
    </>
  );
}

export default CustomerCRUD;

CustomerCRUD.propType = {};
