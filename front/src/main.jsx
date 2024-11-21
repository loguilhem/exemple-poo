import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import App from './App.jsx'
import 'bootstrap/dist/css/bootstrap.min.css';
import Container from 'react-bootstrap/Container';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';

createRoot(document.getElementById('root')).render(
  <StrictMode>
    <Container>
      <Row>
        <Col>
          <App />
        </Col>
      </Row>
    </Container>
  </StrictMode>,
)
