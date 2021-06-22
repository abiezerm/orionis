import PropTypes from 'prop-types';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Form from 'react-bootstrap/Form';
import Modal from 'react-bootstrap/Modal';
import Card from 'react-bootstrap/Card';
import Button from 'react-bootstrap/Button';
import ListGroup from 'react-bootstrap/ListGroup';
import ListGroupItem from 'react-bootstrap/ListGroupItem';

function CustomerAddressesModal(props) {
  return (
    <Modal show={props.show} onHide={props.onCloseClick}>
      <Modal.Header closeButton>
        <Modal.Title>{props.selectedRecord.firstname} - Addresses</Modal.Title>
      </Modal.Header>
      <Modal.Body>
        {props.selectedRecord && props.selectedRecord.addresses.map((address, index) => {
          
          return <Card style={{marginTop: '20px'}}>
            <Card.Body>
              <Card.Title>Address #{index + 1} </Card.Title>
              <ListGroup>
                <ListGroupItem><strong>Address Line #1: </strong>{address['address_line1']}</ListGroupItem>
                <ListGroupItem><strong>Address Line #2: </strong>{address['address_line2']}</ListGroupItem>
                <ListGroupItem><strong>Country Name: </strong>{address['country_name']}</ListGroupItem>
                <ListGroupItem><strong>Country Name: </strong>{address['state_name']}</ListGroupItem>
                <ListGroupItem><strong>City Name: </strong>{address['city_name']}</ListGroupItem>
              </ListGroup>
            </Card.Body>
          </Card>
          // <p><strong>Address Line #1: </strong>{address['address_line1']}</p>
          // return <p>{address['address_line1']}</p>;
        })}
      </Modal.Body>
    </Modal>
  );
};

export default CustomerAddressesModal;

CustomerAddressesModal.propTypes = {
  selectedRecord: PropTypes.object,
  show: PropTypes.bool,
  onCloseClick: PropTypes.func
};
