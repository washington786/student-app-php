DROP TABLE IF EXISTS `students`;

CREATE TABLE `students` (
    `student_no` INT(11) NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(50) NOT NULL,
    `last_name` VARCHAR(50) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `address` VARCHAR(255) NOT NULL,
    `course` VARCHAR(255) NOT NULL,
    `faculty` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`student_no`)
);