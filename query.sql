create table if not exists students (
    ID int PRIMARY KEY,
    Name text not null,
    Dept text not null,
    Course text not null,
    CGPA float not null
);

-- Insert some sample data
INSERT INTO students (ID, Name, Dept, Course, CGPA) VALUES
(21, 'John Smith', 'Computer Science', 'Introduction to Programming', 3.8),
(22, 'Jane Doe', 'Physics', 'Classical Mechanics', 3.9),
(23, 'Peter Jones', 'Mathematics', 'Calculus I', 3.7),
(24, 'Alice Wonderland', 'Literature', 'English Composition', 3.5),
(25, 'Bob The Builder', 'Engineering', 'Structural Design', 3.2),
(26, 'Charlie Chaplin', 'Film Studies', 'History of Cinema', 3.9);

-- Select all students
SELECT * FROM students;

-- Select students from a specific department
SELECT * FROM students WHERE Dept = 'Computer Science';

-- Update a student's CGPA
UPDATE students SET CGPA = 3.9 WHERE ID = 21;

-- Delete a student
DELETE FROM students WHERE ID = 23;

create table if not exists users (
    Mail VARCHAR(255) primary key,
    Pass text not null
);

-- Insert some sample user data
INSERT INTO users (Mail, Pass) VALUES
('user1@example.com', 'pass123'),
('admin@example.com', 'adminpass'),
('test@example.com', 'testpass');
