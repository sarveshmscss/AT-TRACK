import React, { useState, useEffect } from "react";
import {
  Button,
  Form,
  Input,
  Label,
  Spinner,
  Table,
  Typography,
} from "reactstrap";

const AttendanceTracker = () => {
  const [admin, setAdmin] = useState(null);
  const [faculty, setFaculty] = useState(null);
  const [student, setStudent] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    // Get the admin data from the server.
    fetch("/api/admin")
      .then((response) => response.json())
      .then((data) => {
        setAdmin(data);
        setLoading(false);
      });
  }, []);

  useEffect(() => {
    // Get the faculty data from the server.
    fetch("/api/faculty")
      .then((response) => response.json())
      .then((data) => {
        setFaculty(data);
      });
  }, []);

  useEffect(() => {
    // Get the student data from the server.
    fetch("/api/student")
      .then((response) => response.json())
      .then((data) => {
        setStudent(data);
      });
  }, []);

  return (
    <div>
      <Typography variant="h1">Attendance Tracker</Typography>
      <hr />
      {loading ? (
        <Spinner />
      ) : (
        <div>
          <h2>Admin</h2>
          <Table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
              </tr>
            </thead>
            <tbody>
              {admin?.map((item) => (
                <tr key={item.id}>
                  <td>{item.id}</td>
                  <td>{item.name}</td>
                </tr>
              ))}
            </tbody>
          </Table>
          <h2>Faculty</h2>
          <Table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
              </tr>
            </thead>
            <tbody>
              {faculty?.map((item) => (
                <tr key={item.id}>
                  <td>{item.id}</td>
                  <td>{item.name}</td>
                </tr>
              ))}
            </tbody>
          </Table>
          <h2>Student</h2>
          <Table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Attendance</th>
              </tr>
            </thead>
            <tbody>
              {student?.map((item) => (
                <tr key={item.id}>
                  <td>{item.id}</td>
                  <td>{item.name}</td>
                  <td>{item.attendance}</td>
                </tr>
              ))}
            </tbody>
          </Table>
        </div>
      )}
    </div>
  );
};

export default AttendanceTracker;