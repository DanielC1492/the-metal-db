import React, { useState } from 'react';
import axios from 'axios';
import { useHistory } from 'react-router-dom';
import { connect, } from 'react-redux';
import { LOGIN } from "../../redux/types/userTypes";
import { ADMINLOGIN } from "../../redux/types/adminTypes";
import { Navbar } from '../../Components/Navbar/Navbar';
import background from '../../img/background-concert.jpg';
import checkError from '../../tools/error.handlers';

const Login = (props) =>{

    const history = useHistory();

    const [user, setUser] = useState({
        email : '',
        password : '',
        userType: 'User'
        
    });

    console.log(user);

    const [message, setMessage] = useState('')

    const stateHandler = (event) => {
        setUser({...user, [event.target.name]: event.target.type === "number" ? +event.target.value : event.target.value});
    }
    console.log(props)
    const handleOnKeyDown = ( event ) => {
        if(event.keyCode === 13) sendData()
    }
    
    const sendData = async () => {
        try {
            if(user.userType === 'User'){
            const res = await axios.post('http://localhost:8000/api/login', user)
                console.log(res)
                localStorage.setItem("token", JSON.stringify(res))
                localStorage.setItem("user", JSON.stringify(res.data.user))
                props.dispatch({type: LOGIN, payload: res.data})    
                console.log(res)
                props.dispatch({type: LOGIN, payload: res.data})
                
                return setTimeout(() => {
                    history.push('/')
                }, 1000)
   
            }else{
                const resAdmin = await axios.post('http://localhost:3000/api/login', user)
                localStorage.setItem("token", JSON.stringify(resAdmin))
                localStorage.setItem("clinic", JSON.stringify(resAdmin.data.clinic))
                props.dispatch({type: ADMINLOGIN, payload: resAdmin.data})

                return setTimeout(() => {
                    history.push('/')
                }, 1000)
            } 
        }catch(error){
            setMessage('Email or password not found');
        }
        
    };
    
    const redirect = () => {
        return setTimeout(() => {
          history.push('/signup')
        }, 1000);

    }

    const [password, setPassword] = useState({
        hideShow : 'password'
    });
    
    const [checkbox, setCheckbox] = useState(false) 
    
    const toggle = () => {
        setCheckbox(!checkbox);
        if(password.hideShow === 'password' ){
            return setPassword({
                ...password,hideShow: 'text'
            })
        }else{
            return setPassword({
                ...password,hideShow : 'password'
            })
        }
    }

    return(
        <>
        <Navbar/>
        <div className='loginContainer' style={{ backgroundImage: `url(${background})`}} >
            <div className='black'>
                <div className='cardLogin'>
                    <p>Email :</p>
                    <input type='text' className='emailInput' maxLength='50' placeholder="" name="email" onChange={stateHandler}></input>
                    <p>Password :</p>
                    <input type={password.hideShow} className='passInput' maxLength='50' placeholder="" name="password" onChange={stateHandler} onKeyDown={handleOnKeyDown} ></input>
                    <div className='showPWDiv'>
                    <input checked= {checkbox} type= 'checkbox' onChange={() => toggle()} className='showPW' name='showPS'></input>
                    <p className='showPWText'>Show Password</p>
                    </div> 
                    <select className="select" name="userType" defaultValue={'DEFAULT'} onChange={stateHandler}>
                        <option value="User">User</option>
                        <option value="Admin">Admin</option>
                    </select>
                    <button className='loginBtn' onClick={()=> sendData()}>Login</button>
                    <div onClick={() => redirect()} className='createAccount'>
                    Not a client? Sign up.
                    </div>
                    <div className="button">
                        {/* <Boton name='Back'  destination=''/> */}
                    </div>
                    <div className='errorMessage'>{message}</div>
                </div>
            </div>      
        </div>
        </>
    )
}
export default connect() (Login);
