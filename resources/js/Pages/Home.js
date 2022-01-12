import React from 'react';
import Footer from '@/Layouts/Footer';
import Login from '@/Pages/Auth/Login';
import 'bootstrap/dist/css/bootstrap.min.css';
import NavBarGuest from '@/Layouts/Navbar/NavBarGuest';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Container from 'react-bootstrap/Container';
import Card from 'react-bootstrap/Card';
import Banner from '../../svg/banner.jpg';
import '../Layouts/Layout.css';

export default function Home() {
    return (
        <>
            <NavBarGuest/>
            <Container>
                <Card className='dted-rounded'>
                    <Card.Body>
                        <Row className='h-100 justify-content-center align-items-center'>
                            <Col md={6} sm={8}>
                                <img className='img-fluid' src={Banner} />
                            </Col>
                            <Col md={6} sm={8}>
                                <Login canResetPassword={false}/>
                            </Col>
                        </Row>
                    </Card.Body>
                </Card>
            </Container>
            <Footer/>
        </>
    );
}
