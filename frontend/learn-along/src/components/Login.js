import '../App.css';
import logo from '../images/icon.jpg';
import Button from './Button';
import { fetch } from '../hooks/fetch';



const onClick = async () => {
    const data = {
        "email": document.getElementById("email").value,
        "password": document.getElementById("password").value
    }
    const result = await fetch("auth/login",data)
    localStorage.setItem('jwt',result.data.token_type + " " + result.data.access_token)

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