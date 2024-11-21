import React, { useEffect, useState } from 'react';
import Table from 'react-bootstrap/Table';
//import Spinner from

const App = () => {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    // URL de l'API à interroger
    const apiUrl = "http://localhost:8085/dashboard.php";

    fetch(apiUrl)
      .then((response) => {
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
      })
      .then((json) => {
        setData(json.data); // Stocker les données
        setLoading(false); // Fin du chargement
      })
      .catch((error) => {
        setError(error.message); // Gérer les erreurs
        setLoading(false);
      });
  }, []); // [] pour ne faire la requête qu'une seule fois

  if (loading) return 
  <div>
    Spinner 
  </div>
  ;
  if (error) return <div>Error: {error}</div>;

  return (
    <div>
      <h1>La liste de questions</h1>

      <Table striped bordered hover>
        <thead>
          <tr>
            <th>Id</th>
            <th>Texte</th>
            <th>Editer</th>
            <th>Supprimer</th>
          </tr>
        </thead>
        <tbody>
          {data.map((item) => (
            <tr key={item.id}>
              <td key={item.id}>{item.id}</td>
              <td>{item.text}</td>
              <td>Edit</td>
              <td>Supprimer</td>
            </tr>
          ))}
        </tbody>
      </Table>
    </div>
  );
};

export default App;