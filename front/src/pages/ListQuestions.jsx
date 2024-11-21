import React, { useEffect, useState } from 'react';
import Table from 'react-bootstrap/Table';
import ToggleStatusDisplay from '../components/ToggleStatusDisplay';
import { Link } from 'react-router-dom';

const ListQuestions = () => {
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
        <>
        <h1>La liste de questions</h1>
            <Table striped bordered hover>
            <thead>
                <tr>
                <th>Id</th>
                <th>Texte</th>
                <th>Editer</th>
                <th>Etat</th>
                </tr>
            </thead>
            <tbody>
                {data.map((question) => (
                <tr key={question.id}>
                    <td key={question.id}>{question.id}</td>
                    <td>{question.text}</td>
                    <td><Link to={`/editQuestion/${question.id}`}>Edit</Link></td>
                    <td><ToggleStatusDisplay status={question.status}></ToggleStatusDisplay></td>
                </tr>
                ))}
            </tbody>
            </Table>
        </>
    )
};

export default ListQuestions;