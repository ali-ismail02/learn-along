import React from "react";
import Fetch from "../hooks/Fetch";
import { useEffect, useState } from "react";
import Button from "./Button";
import CourseFucntions from "./CourseFucntions";
import AdminNavbar from "./AdminNavbar";

const Table = (props) => {
    const { url, headers, deleteUrl } = props
    const [datas, setData] = useState([])

    useEffect(() => {
        const getUsers = async () => {
            const result = await Fetch(url, null, localStorage.jwt)
            const data = result.data.message
            setData(data)
        }
        getUsers()
    }, [url])

    const deleteUser = async (id) => {
        let url = deleteUrl
        const data = { id }
        const result = await Fetch(url, data, localStorage.jwt)
        setData(datas.filter((data, i) => data._id !== id))
    }

    return (
        <>
        <AdminNavbar></AdminNavbar>
        <table className="display-info">
            <thead>
                <tr>
                    {headers.map((header, index) => {
                        return (<th key={index}>{header}</th>)
                    })}
                </tr>
            </thead>
            <tbody>
                {datas.map((user, index) => {
                    return (
                        <tr key={index}>{
                            Object.entries(user).filter(([key, value]) => {
                                return headers.includes(key)
                            }).map(([key, value]) => {
                                return (<td key={key}>{value}</td>)
                            })}
                            <td>
                            <Button text={"Delete"} onClick={() => {deleteUser(user._id)}} />
                            {url == "admin/courses" && <CourseFucntions course_id={user._id} datas={datas} setData={setData}/>}
                            </td></tr>
                    )
                })}
            </tbody>
        </table>
        </>
    );
}

export default Table;