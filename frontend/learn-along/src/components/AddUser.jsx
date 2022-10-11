import '../App.css';
import logo from '../images/icon.jpg';
import Button from './Button';
import Fetch from '../hooks/Fetch';
import { Link,useNavigate } from 'react-router-dom';
import { useState } from 'react';
const AddUser = () => {
    const [email,setEmail] = useState("")
    const [password,setPassword] = useState("")
    const [full_name,setName] = useState("")
    const [gender,setGender] = useState("")
    const [type,setType] = useState("")
    const [dob,setDate] = useState("")
    const nav = useNavigate()

    const onClick = async () => {
        const data = {
            email,password,name:full_name,gender,type,image:null,dob
        }
        console.log(dob)
        const result = await Fetch("admin/register",data,localStorage.jwt)
        if(result.data.status == 1){
            if(type == "instructor") nav("/admin/instructors")
            nav("/admin/students")
        }
    }
    console.log('hi')
    return <div className='main-login'>
        <div className='add-form'>
            <h3>Register User</h3>
            <input type="text" placeholder='Name' value={full_name} onChange={(e) => setName(e.target.value)}/>
            <input type="email" placeholder='email' value={email} onChange={(e) => setEmail(e.target.value)}/>
            <input type="password" placeholder='password' value={password} onChange={(e) => setPassword(e.target.value)}/>
            <div>
            <p className="radio-text">Gender</p>
            <input className="radio" type="radio" id="gender" name="gender" value="Female" onChange={(e) => setGender(e.target.value)}/>
            <label for="female">Female</label>
            <input className="radio" type="radio" id="gender" name="gender" value="Male" onChange={(e) => setGender(e.target.value)}/>
            <label for="male">Male</label>
            </div>
            <div>
            <p className="radio-text">User type</p>
            <input className="radio" type="radio" id="user-type" name="user-type" value={"student"} onChange={(e) => setType(e.target.value)}/>
            <label for="student">Student</label>
            <input className="radio" type="radio" id="user-type" name="user-type" value={"instructor"} onChange={(e) => setType(e.target.value)}/>
            <label for="instructor">Instructor</label>
            <input type="date" value={dob} onChange={(e) => setDate(e.target.value)}></input>
            </div>
            <Button onClick={onClick} text="Register"/>
        </div>
    </div>
}
  
export default AddUser;