CREATE TABLE IF NOT EXISTS user (
    id INT NOT NULL AUTO_INCREMENT ,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(50) NOT NULL,
    country VARCHAR(100),
    state VARCHAR(100),
    city VARCHAR(100),
    gender ENUM('M', 'F', 'O') NOT NULL,
    maritalStatus ENUM('S', 'M', 'W', 'D') NOT NULL,
    mobileNo VARCHAR(10),
    address TEXT,
    dob DATE,
    hireDate DATE NOT NULL,
    status ENUM('0', '1') DEFAULT '1',
    user_type ENUM('A', 'E') NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(id),
    UNIQUE KEY(email)
);

CREATE TABLE IF NOT EXISTS  project (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    status ENUM('S', 'P', 'H', 'C', 'F') DEFAULT 'P',
    created_by INT NOT NULL,
    team_id INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(id),
    FOREIGN KEY(created_by) REFERENCES user(id),
    FOREIGN KEY(team_id) REFERENCES project_team(id)
);

CREATE TABLE IF NOT EXISTS project_member (
    id INT NOT NULL AUTO_INCREMENT,
    team_id INT NOT NULL,
    user_id INT NOT NULL,
    project_id INT NOT NULL,
    task_id INT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (project_id) REFERENCES project(id),
    FOREIGN KEY (team_id) REFERENCES project_team(id),
    FOREIGN KEY (task_id) REFERENCES task(id)
);

CREATE TABLE IF NOT EXISTS project_team(
    id INT NOT NULL AUTO_INCREMENT,
    project_id INT NOT NULL,
    total_member INT NOT NULL,
    user_id INT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (project_id) REFERENCES project(id),
    FOREIGN KEY (user_id) REFERENCES user(id)
);

CREATE TABLE IF NOT EXISTS task(
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL ,
    description TEXT NOT NULL,
    assign_to INT NOT NULL,
    assignment_date DATE NOT NULL,
    start_date DATE NOT NULL,
    due_date DATETIME NOT NULL,
    status ENUM('O', 'P', 'C') NOT NULL,
    priority ENUM('H', 'M', 'L'),
    project_id INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(id),
    FOREIGN KEY (assign_to) REFERENCES user(id),
    FOREIGN KEY (project_id) REFERENCES project(id)
);

CREATE TABLE IF NOT EXISTS comment(
    id INT NOT NULL AUTO_INCREMENT,
    task_id INT NOT NULL,
    project_id INT NOT NULL,
    commented_by INT NOT NULL,
    comment_date DATETIME NOT NULL,
    comment_text VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(id),
    FOREIGN KEY (task_id) REFERENCES task(id),
    FOREIGN KEY (project_id) REFERENCES project(id),
    FOREIGN KEY (commented_by) REFERENCES user(id)
);

CREATE TABLE IF NOT EXISTS attechments(
    id INT NOT NULL AUTO_INCREMENT,
    task_id INT NOT NULL,
    project_id INT NOT NULL,
    file_name VARCHAR(100) NOT NULL,
    file_path VARCHAR(150) NOT NULL,
    upload_date DATE NOT NULL,
    uploaded_by INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(id),
    FOREIGN KEY (task_id) REFERENCES task(id),
    FOREIGN KEY (project_id) REFERENCES project(id),
    FOREIGN KEY (uploaded_by) REFERENCES user(id)
);
