import '../App.css';
import logo from '../images/icon.jpg';
import Button from './Button';
import Fetch from '../hooks/Fetch';
import { Link,useNavigate } from 'react-router-dom';
import { useState } from 'react';



const LoginForm = () => {
    const [email,setEmail] = useState("")
    const [password,setPassword] = useState("")
    const nav = useNavigate()

    const onClick = async () => {
        const data = {
            "email": email,
            "password": password
        }
        const result = await Fetch("auth/login",data)
        localStorage.setItem('jwt',result.data.token_type + " " + result.data.access_token)
        if(result.data.user_type == 1){
            console.log(result.data);
            nav("/admin/students")
        }
    }
    console.log('hi')
    return <div className='main-login'>
        <div className='login-form'>
            <img src={logo} />
            <input type="text" placeholder='Email' value={email} onChange={(e) => setEmail(e.target.value)}/>
            <input type="password" placeholder='Password' value={password} onChange={(e) => setPassword(e.target.value)}/>
            <Button text={"Login"} onClick={onClick}/>
        </div>
    </div>
}
  
export default LoginForm;