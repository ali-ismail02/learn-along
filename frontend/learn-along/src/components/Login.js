import '../App.css';
import logo from '../images/icon.jpg';
import Button from './Button';
import { fetch } from '../hooks/fetch';


const onClick = async () => {
    const data = {
        "email": document.getElementById("email").value,
        "Password": document.getElementById("password").value
    }
    const result = await fetch("auth/login",data)
    console.log(result)
}

const LoginForm = () => {
    return <div className='main-login'>
        <div className='login-form'>
            <img src={logo} />
            <input type="text" placeholder='Email' id='email'/>
            <input type="password" placeholder='Password' id='password'/>
            <Button text={"Login"} onClick={onClick}/>
        </div>
    </div>
}
  
export default LoginForm;