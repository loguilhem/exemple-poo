import React from 'react';
import Badge from 'react-bootstrap/Badge';

const ToggleStatusDisplay = ({status}) => {

    let bg = 'primary';
    let state = 'Activé';
    if (0 === status) {
        bg = 'danger';
        state = 'Désactivé';
    }

    return (
        <Badge pill bg={bg}>
            {state}
        </Badge>
    )
}

export default ToggleStatusDisplay;