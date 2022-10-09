import '../App.css';
import logo from '../images/logo.webp';

const LoginForm = () => {
    return <div className='main-login'>
        <div className='login-form'>
            <img src={logo} />
            <input type="text" placeholder='Email' id='email'/>
            <input type="password" placeholder='Password' id='password'/>
        </div>
    </div>
}
  
export default LoginForm;