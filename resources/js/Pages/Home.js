
import Login from '@/Pages/Auth/Login';
import Footer from '@/Layouts/Footer';
import NavBarGuest from '@/Layouts/Navbar/NavBarGuest';

import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Card from 'react-bootstrap/Card';
import Container from 'react-bootstrap/Container';

import Banner from '../../svg/banner.jpg';
import 'bootstrap/dist/css/bootstrap.min.css';
import '../Layouts/Layout.css';
import { Head } from '@inertiajs/inertia-react';

export default function Home() {
    return (
        <>
            <Head title="SMCA"/>
            <NavBarGuest/>
            <Container>
                {/* <Card className='w-75 mx-auto dted-card border-0'>
                    <Card.Body className='flex items-center justify-start'>
                        <Card.Title as="h2"> DTED - SMCA </Card.Title>
                        <Card.Subtitle as="h5" className="mb-1 text-muted">(Sistema de monitoramento da Central de Atendimento)</Card.Subtitle>
                    </Card.Body>
                    <Card.Body>
                        <Row className="dted-card-body h-100 justify-content-center align-items-center ">
                            <Col md={6}>
                                <img className='' src={Banner}/>
                            </Col>
                            <Col md={6}>
                                    <Login canResetPassword={true}/>
                            </Col>
                        </Row>
                    </Card.Body>
                </Card> */}

                <div className='mx-auto dted-home-title'>
                    <div className='row g-0'>
                        <div className='col-md-4'>
                            <h2 className='text-center'>DTED - SMCA</h2>
                        </div>
                        <div className='col-md-8 p-2'>
                            <h5 className='text-center'>(Sistema de monitoramento da Central de Atendimento)</h5>
                        </div>
                    </div>
                </div>
                <div className="mx-auto dted-card-home">
                    <div className="row g-0 align-items-center">
                        <div className="col-md-6">
                            <img src={Banner} className="img-fluid dted-card-image"/>
                        </div>
                        <div className="col-md-6">
                            <div className="card-body">
                                <Login canResetPassword={true}/>
                            </div>
                        </div>
                    </div>
                </div>
            </Container>
            <Footer/>
        </>
    );
}
