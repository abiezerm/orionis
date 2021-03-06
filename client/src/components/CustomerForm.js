import PropTypes from 'prop-types';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Form from 'react-bootstrap/Form';
import Modal from 'react-bootstrap/Modal';
import Button from 'react-bootstrap/Button';
import DatePicker from 'react-datepicker';

function CustomerForm(props) {
  function handleInputChange(e) {
    props.onInputChange(e);
  }

  function handleDateInputChange(date, name) {
    props.onDateInputChange(date, name);
  }

  function handleSubmitClick(e) {
    e.preventDefault();
    props.onSubmitClick();
  }

  return (
    <Modal show={props.show} onHide={props.onCloseClick}>
      <Modal.Header closeButton>
        <Modal.Title>Customer Form - {props.action === 'add' ? 'Add Record' : 'Edit Record'}</Modal.Title>
      </Modal.Header>
      <Modal.Body>
        <Form>
          {props.action === 'edit' && (
            <Form.Group>
              <Form.Label>Id</Form.Label>
              <Form.Control name="id" type="text" value={props.formValues.id} disabled/>
            </Form.Group>
          )}
          <Form.Group>
            <Form.Label>FirstName</Form.Label>
            <Form.Control name="firstname" type="text" placeholder="Enter Firstname" value={props.formValues.firstname} onChange={handleInputChange} />
          </Form.Group>
          <Form.Group>
            <Form.Label>LastName</Form.Label>
            <Form.Control name="lastname" type="text" placeholder="Enter LastName" value={props.formValues.lastname} onChange={handleInputChange} />
          </Form.Group>
          <Form.Group>
            <Form.Label>Email</Form.Label>
            <Form.Control name="email" type="email" placeholder="Enter Email" value={props.formValues.email} onChange={handleInputChange} />
          </Form.Group>
          <Form.Group>
            <Form.Label>Phone</Form.Label>
            <Form.Control name="phone" type="text" placeholder="Enter Phone" value={props.formValues.phone} onChange={handleInputChange} />
          </Form.Group>
          <Form.Group>
            <Form.Label>BirthDate</Form.Label>
            <div>
              <DatePicker name="birthdate" dateFormat="yyyy/MM/dd" selected={props.formValues.birthdate} onChange={(date) => handleDateInputChange(date, 'birthdate')} />
            </div>
          </Form.Group>
          <Form.Group>
            <Form.Label>Gender</Form.Label>
            <div className="mb-3">
              <Form.Check 
                name="gender" 
                inline 
                label='M' 
                value="M" 
                type="radio" 
                checked={props.formValues.gender === 'M'} 
                onChange={handleInputChange}
              />
              <Form.Check 
                name="gender" 
                inline 
                label='F'
                value='F' 
                type="radio" 

                checked={props.formValues.gender === 'F'} 
                onChange={handleInputChange}
              />
              <Form.Check 
                name="gender" 
                inline 
                label='U' 
                value='U' 
                type="radio" 
                checked={props.formValues.gender === 'U'} 
                onChange={handleInputChange}
              />
            </div>
          </Form.Group>
        </Form>
      </Modal.Body>

      <Modal.Footer>
          <Button variant="primary" type="submit" onClick={handleSubmitClick}>Submit</Button>
        <Button variant="secondary" onClick={props.onCloseClick}>Close</Button>
      </Modal.Footer>
    </Modal>
  );
}

export default CustomerForm;

CustomerForm.propTypes = {
  action: PropTypes.string,
  show: PropTypes.bool,
  onInputChange: PropTypes.func,
  onDateInputChange: PropTypes.func,
  formValues: PropTypes.object,
  onSubmitClick: PropTypes.func,
  onCloseClick: PropTypes.func
};
