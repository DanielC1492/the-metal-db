import React from 'react';
import { Link } from 'react-router-dom';
import Header from '../Header/Header';

const Navbar = () => {
    return (
        <div className="navContainer">         
            <ul className="nav">
                <li><Link to="/">Home</Link></li>
                <li><Link to="/login">Login</Link></li>
                <li><Link to="/signup">SignUp</Link></li>
                <li><Link to="/shop">Shop</Link></li>        
            </ul>
        </div>
    )
}

const NavbarProfile = () => {
    return (   
        <div className="navProfileContainer">
            <ul className="navProfile">
                <li><Link to="/shop">Pending Appointments</Link></li>
                <li><Link to="/profile/schedule">Schedule an appointment</Link></li>
                <li><Header>LogOut</Header></li>        
            </ul>  
        </div>
    )
} 

const NavbarAdmin = () => {
    return (
        <div /*style={{ backgroundImage: `url(${bannerImg})`}}*/>
            <div>
                <ul className="nav">
                    <li><Link to="/allAppointments">All Appointments</Link></li>
                    <li><Link to="/showClients">All Clients</Link></li>
                    <li><Header>LogOut</Header></li>        
                </ul>
            </div>  
        </div>
    )
}


export {
    Navbar,
    NavbarProfile,
    NavbarAdmin  
} 
