import React from "react";
import Fetch from "../hooks/Fetch";
import { useEffect, useState } from "react";

const CourseFucntions = ({ course_id, datas, setData }) => {

    const [students, setStudents] = useState([])
    const [instructors, setInstructors] = useState([])

    useEffect(() => {
        console.log("hi")
        const getUsers = async () => {
            const students = await Fetch("admin/students", null, localStorage.jwt)
            const instructors = await Fetch("admin/instructors", null, localStorage.jwt)
            let data = students.data.message
            setStudents(data)
            data = instructors.data.message
            setInstructors(data)
        }
        getUsers()
    }, [])

    const assignInstructor = async (course_id, instructor_id) => {
        const data = { course_id, instructor_id }
        const result = await Fetch("admin/assign", data, localStorage.jwt)
        setData(datas.map((data, key) => {
            if (data._id == course_id) {
                data.instructor = instructor_id
            }
        }))
    }

    const enrollStudent = async (course_id, student_id) => {
        const data = { course_id, student_id }
        const result = await Fetch("admin/enroll", data, localStorage.jwt)
        alert(result.message)
    }

    let instructor_id
    let student_id
    return <>
        <div className="flex-col">
            <p>Assign Instructor</p>
            <select onChange={(e) => {
                instructor_id = e.target.value
                assignInstructor(course_id, instructor_id)
            }} placeholder="Instructor">
                {instructors.map((instructor, i) => {
                    return <option key={i} value={instructor._id}>{instructor.name}</option>
                })}
            </select>
        </div>
        <div className="flex-col">
            <p>Enroll Student</p>
            <select id="students" onChange={(e) => {
                student_id = e.target.value
                enrollStudent(course_id, student_id)
            }} placeholder="student">
                {students.map((std, i) => {
                    return <option key={i} value={std._id}>{std.name}</option>
                })}
            </select>
        </div>
    </>
}

export default CourseFucntions