import { Link } from "react-router-dom";
const AdminNavbar = () => {
    return (
        <div className="nav-container">
            <nav>
                <ul className="desktop-nav">
                    <li>
                        <Link to="/admin/students">Students</Link>
                    </li>
                    <li>
                        <Link to="/admin/instructors">Instructors</Link>
                    </li>
                    <li>
                        <Link to="/admin/courses">Courses</Link>
                    </li>
                    <li>
                        <Link to="/admin/add-user">Add User</Link>
                    </li>
                </ul>
            </nav>
        </div>
    );
}
export default AdminNavbar;