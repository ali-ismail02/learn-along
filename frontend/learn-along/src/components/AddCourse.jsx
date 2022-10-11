import '../App.css';
import logo from '../images/icon.jpg';
import Button from './Button';
import Fetch from '../hooks/Fetch';
import { Link,useNavigate } from 'react-router-dom';
import { useState } from 'react';
const AddCourse = () => {
    const [course_name,setName] = useState("")
    const nav = useNavigate()

    const onClick = async () => {
        const data = {
            name:course_name
        }
        const result = await Fetch("admin/add-course",data,localStorage.jwt)
        if(result.data.status == 1){
            nav("/admin/courses")
        }
    }
    console.log('hi')
    return <div className='main-login'>
        <div className='add-form'>
            <h3>Register User</h3>
            <input type="text" placeholder='Name' value={course_name} onChange={(e) => setName(e.target.value)}/>
            <Button onClick={onClick} text="Add Course"/>
        </div>
    </div>
}
  
export default AddCourse;