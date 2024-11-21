import React, { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';
import Button from 'react-bootstrap/Button';
import Form from 'react-bootstrap/Form';

const FormQuestion = () => {
    // on récupère l'id dans les paramètres s'il existe
    const {id} = useParams('id');
    const [data, setData] = useState(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        if (id) {
            // URL de l'API à interroger
            const apiUrl = "http://localhost:8085/dashboard.php?id="+id+"&action=read";

            fetch(apiUrl)
            .then((response) => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then((json) => {
                setData(json); // Stocker les données
                setLoading(false);
            }).catch((error) => {
                setError(error.message); // Gérer les erreurs
                setLoading(false);
            })
        } 
    }, []);

    

    if (loading) return 
    <div>
        Spinner 
    </div>
    ;
    if (error) return <div>Error: {error}</div>;

    return (
        <>
            <h1>{id ? 'Modifier la question' : 'Ajouter une question'}</h1>
            <Form>
                <Form.Group className='mb-6'>
                    <Form.Label>Texte de la question</Form.Label>
                    <Form.Control type="text" placeholder="fds" defaultValue={data.question.text} required />
                </Form.Group>
                <Form.Group className='mb-6'>
                    <Form.Check type='switch' label="Activer/désactiver"></Form.Check>
                </Form.Group>
                <Form.Group className="mb-6">

                </Form.Group>
                <Button type="submit">Sauvegarder</Button>
            </Form>
        </>
    )
};

export default FormQuestion;