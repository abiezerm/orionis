import { useEffect, useState } from 'react';
import PropTypes from 'prop-types';
import Jumbotron from 'react-bootstrap/Jumbotron';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Button from 'react-bootstrap/Button';
import Spinner from 'react-bootstrap/Spinner';
import CustomerForm from './CustomerForm';
import AddressForm from './AddressForm';
import CustomerAddressesModal from './CustomerAddressesModal';
import * as APIUtils from '../api/APIUtils';
import Datatable from 'react-data-table-component';

function CustomerCRUD(props) {
  const [customersData, setCustomersData] = useState([]);
  const [countriesData, setCountriesData] = useState([]);
  const [statesData, setStatesData] = useState([]);  
  const [isLoading, setIsLoading] = useState(false);
  const [isError, setIsError] = useState(false);
  const [showAddCustomerForm, setShowAddCustomerForm] = useState(false);
  const [showEditCustomerForm, setShowEditCustomerForm] = useState(false);
  const [showAddressForm, setShowAddressForm] = useState(false);
  const [showCustomerAddressesModal, setShowCustomerAddressesModal] = useState(false);
  const [selectedRecord, setSelectedRecord] = useState({addresses: []});

  const [customerForm, setCustomerForm] = useState({
    firstname: '',
    lastname: '',
    email: '',
    phone: '',
    birthdate: new Date(),
    gender: 'M'
  });

  const [addressForm, setAddressForm] = useState({
    addressLine1: '',
    addressLine2: '',
    countryId: 230,
    stateId: '',
    city: '',
    zipcode: ''
  });


  useEffect(() => {
    const fetchData = async () => {
      setIsError(false);
      setIsLoading(true);
      try {
        getCustomersData();
        const countriesResult = await APIUtils.getCountries();
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

  async function getCustomersData() {
    const customersResult = await APIUtils.getCustomers();
    setCustomersData(customersResult.data);
  }
  

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

  async function handleAddCustomerFormSubmit() {
    if (Object.keys(validateForm(customerForm)).length === 0) {
      const response = await APIUtils.addCustomer(customerForm);

      if (!response.error) {
        alert('Record added succesfully');
        getCustomersData();
        clearCustomerForm();
      } else {
        alert('Error adding record');
      }
    } else {
      alert('Please fill correctly all the fields');
    }
  }

  async function handleEditCustomerFormSubmit() {
    if (Object.keys(validateForm(customerForm)).length === 0) {
      const response = await APIUtils.editCustomer(customerForm);

      if (!response.error) {
        alert('Record edited succesfully');
        getCustomersData();
      } else {
        alert('Error editing record');
      }
    } else {
      alert('Please fill correctly all the fields');
    }
  }

  // handle Datatable action buttons
  async function handleCustomerDelete(e) {
    const id = e.target.id;
    const userConfirmation = window.confirm(`Are you sure you want to delete this record with id: ${id}?`);
    if (userConfirmation) {
      const responseStatusCode = await APIUtils.deleteCustomer(id);

      if (responseStatusCode === 204) {
        // reset datatable
        getCustomersData();
      }

      if (responseStatusCode === 404) {
        alert(`Failed to delete record with id: ${id}, 404 Record not found`);
      }
    }
  }

  async function handleCustomerEdit(e) {
    const id = e.target.id;
    const record = await APIUtils.getCustomerById(id);

    // fill form state from the record
    setCustomerForm({
      id: record.id,
      firstname: record.firstname,
      lastname: record.lastname,
      email: record.email,
      phone: record.phone,
      birthdate: new Date(`${record.birthdate} `),
      gender: record.gender
    });

    showCustomerForm('edit');
  }

  // modal handles
  function showCustomerForm(action='add') {
    if (action === 'add') {
      setShowAddCustomerForm(true);
    } else {
      setShowEditCustomerForm(true);
    }
  }

  function hideCustomerForm(action='add') {
    clearCustomerForm();
    if (action === 'add') {
      setShowAddCustomerForm(false);
    } else {
      setShowEditCustomerForm(false);
    }
  }

  function showAddressFormModal() {
    setShowAddressForm(true);
  }

  function hideAddressFormModal() {
    setShowAddressForm(false);
  }

  async function handleShowCustomerAddresses(e) {
    const id = e.target.id;
    const record = await APIUtils.getCustomerById(id);

    setSelectedRecord(record);
    setShowCustomerAddressesModal(true);
  }

  function validateForm(form) {
    const inputs = form;
    const errors = {};

    for (const key in inputs) {
      if (key === 'id') continue;
      
      if (!inputs[key]) {
        errors[key] = `${key} cannot be empty`;
      }
    }
    
    return errors;
  }

  function clearCustomerForm() {
    setCustomerForm({
      id: '',
      firstname: '',
      lastname: '',
      email: '',
      phone: '',
      birthdate: new Date(),
      gender: 'M'
    });
  }

  const customerDatatableColumns = [
    {
      name : 'id',
      selector: 'id',
      sortable: true
    },
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
    {
      cell: (row) => (
        <Button id={row.id} onClick={handleShowCustomerAddresses}>Addresses</Button>
      ),
      button: true
    },
    {
      cell: (row) => (
        <Button id={row.id} onClick={handleCustomerEdit}>Edit</Button>
      ),
      button: true
    },
    {
      cell: (row) => (
        <Button id={row.id} onClick={handleCustomerDelete}>Delete</Button>
      ),
      button: true
    }
  ];

  return (
    <div style={{marginTop: '30px'}}>
      {isLoading
        ? <Spinner animation="border" />
        :
        <>
          <Button onClick={() => showCustomerForm('add')}>Add new Record</Button>
          <CustomerForm 
            action='add'
            show={showAddCustomerForm}
            onCloseClick={() => hideCustomerForm('add')}
            formValues={customerForm} 
            onSubmitClick={handleAddCustomerFormSubmit}
            onInputChange={handleCustomerFormInputChange} 
            onDateInputChange={handleCustomerFormDateInputChange} 
          />

          <CustomerForm 
            action='edit'
            show={showEditCustomerForm}
            onCloseClick={() => hideCustomerForm('edit')}
            formValues={customerForm} 
            onSubmitClick={handleEditCustomerFormSubmit}
            onInputChange={handleCustomerFormInputChange} 
            onDateInputChange={handleCustomerFormDateInputChange} 
          />

          <Datatable 
            title="Customers"
            columns={customerDatatableColumns}
            data={customersData}
          />

          {/* <AddressForm 
            formValues={addressForm}
            onSubmitClick={handleAddressFormSubmit}
            onInputChange={handleAddressFormInputChange}
            countries={countriesData}
            states={statesData}
          /> */}

          <CustomerAddressesModal 
            show={showCustomerAddressesModal}
            onCloseClick={() => setShowCustomerAddressesModal(false)}
            selectedRecord={selectedRecord}
          /> 
        </>
      } 

      {isError && <div>Something went wrong ...</div>}
    </div>
  );
}

export default CustomerCRUD;

CustomerCRUD.propTypes = {};
