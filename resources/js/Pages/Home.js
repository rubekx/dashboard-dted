
import Login from '@/Pages/Auth/Login';
import Footer from '@/Layouts/Footer';
import NavBarGuest from '@/Layouts/Navbar/NavBarGuest';

import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Card from 'react-bootstrap/Card';
import Container from 'react-bootstrap/Container';

import Banner from '../../svg/banner.jpg';
import { Head } from '@inertiajs/inertia-react';
import 'bootstrap/dist/css/bootstrap.min.css';
import '../Layouts/Layout.css';

export default function Home() {
    return (
        <>
            <Head title="SMCA"/>
            <NavBarGuest/>
            <Container>
                <div className='mx-auto dted-home-title'>
                    <Row className='g-0'>
                        <Col md={4}>
                            <Card.Title className='text-center' as="h2"> DTED - SMCA </Card.Title>
                        </Col>
                        <Col md={8} className='p-2'>
                            <Card.Title className='text-center' as="h5">(Sistema de monitoramento da Central de Atendimento)</Card.Title>
                        </Col>
                    </Row>
                </div>
                <div className="mx-auto dted-card-home">
                    <Row className='g-0 align-items-center'>
                        <Col lg={6} md={12} sm={12}>
                            <img src={Banner} className="img-fluid dted-card-image"/>
                        </Col>
                        <Col lg={6} md={12} sm={12}>
                            <Card.Body>
                                <Login canResetPassword={true}/>
                            </Card.Body>
                        </Col>
                    </Row>
                </div>
            </Container>
            <Footer/>
        </>
    );
}
