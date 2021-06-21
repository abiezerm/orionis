import PropTypes, { object } from 'prop-types';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Form from 'react-bootstrap/Form'
import Button from 'react-bootstrap/Button';


function AddressForm(props) {
  return (
    <Row>
      <Form>
        <Form.Group>
          <Form.Label>Address Line 1</Form.Label>
          <Form.Control name="addressLine1" type="text"  placeholder="Enter Address Line 1" value={props.formValues.addressLine1} onChange={props.onInputChange} />
        </Form.Group>
        <Form.Group>
          <Form.Label>Address Line 2</Form.Label>
          <Form.Control name="addressLine2" type="text"  placeholder="Enter Address Line 2" value={props.formValues.addressLine2} onChange={props.onInputChange} />
        </Form.Group>
        <Form.Group>
          <Form.Label>Country</Form.Label>
          <Form.Control name="countryId" as ="select" value={props.formValues.countryId} onChange={props.onInputChange}>
            {props.countries.map(country => {
              return <option value={country.id}>{country.name}</option>
            })}
          </Form.Control>
        </Form.Group>
        <Form.Group>
          <Form.Label>State or Province</Form.Label>
          <Form.Control name="stateId" as="select" value={props.formValues.stateId} onChange={props.onInputChange}>
            {props.states.map(state => {
              return <option value={state.id}>{state.name}</option>
            })}
          </Form.Control>
        </Form.Group>
        <Form.Group>
          <Form.Label>City</Form.Label>
          <Form.Control name="city" type="text"  placeholder="Enter City" value={props.formValues.city} onChange={props.onInputChange} />
        </Form.Group>
        <Form.Group>
          <Form.Label>ZipCode</Form.Label>
          <Form.Control name="zipcode" type="text"  placeholder="Enter ZipCode" value={props.formValues.zipCode} onChange={props.onInputChange} />
        </Form.Group>
      </Form>
    </Row>
  );
}

export default AddressForm;

AddressForm.propTypes = {
  onInputChange: PropTypes.func,
  formValues: PropTypes.object,
  onSubmitClick: PropTypes.func,
  countries: PropTypes.arrayOf(object),
  states: PropTypes.arrayOf(object)
};
