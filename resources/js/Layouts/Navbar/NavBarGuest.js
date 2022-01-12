import './../Layout.css';
import Navbar from 'react-bootstrap/Navbar';
import logo from '../../../svg/dted.svg';
import Container from 'react-bootstrap/Container';

export default function NavBarGuest() {
  return (
    <>
        <Navbar>
            <Container fluid>
                <Navbar.Brand href="#">
                    <img src={logo} className="dted-logo d-inline-block align-top" alt="DTED logo"/>
                </Navbar.Brand>
            </Container>
        </Navbar>
    </>
  )
}
