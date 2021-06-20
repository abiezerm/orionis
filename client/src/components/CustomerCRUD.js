import Proptypes from 'prop-types';
import { useEffect, useState } from 'react';
import * as APIUtils from '../api/APIUtils';

function CustomerCRUD(props) {
  const [data, setData] = useState([]);
  const [isLoading, setIsLoading] = useState(false);
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

  return (
    <>
      {isLoading
        ? (<div>Loading...</div>)
        :
        <h1>Customer Form</h1>
      } 

      {isError && <div>Something went wrong ...</div>}
    </>
  );
}

export default CustomerCRUD;

CustomerCRUD.propType = {};
