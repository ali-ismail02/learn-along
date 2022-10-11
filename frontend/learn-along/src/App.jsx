
import { useState, useEffect } from "react";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Login from "./components/Login";
import StudentsTable from "./components/StudentsTable";
import Table from "./components/Table";
import './App.css';

function App() {
  return (
    <Router>
        <Routes>
          <Route path="/" element={<Login />}> </Route>
          <Route path="/admin/students" element={<Table url={"admin/students"} deleteUrl="admin/delete-user" headers={["name","email","gender","dob","Delete"]}/>}/>
          <Route path="/admin/instructors" element={<Table url={"admin/instructors"} deleteUrl="admin/delete-user" headers={["name","email","gender","dob","Delete"]}/>}/>
          <Route path="/admin/courses" element={<Table url={"admin/courses"} deleteUrl="admin/delete-course" headers={["name","instructor","Functions"]}/>}/>
        </Routes>
    </Router>
  );
}

export default App;
