-- Drop tables if they exist to allow for a clean script execution
DROP TABLE IF EXISTS Experience_Skills;
DROP TABLE IF EXISTS Education_Skills;
DROP TABLE IF EXISTS Certification_Skills;
DROP TABLE IF EXISTS Skills;
DROP TABLE IF EXISTS Certifications;
DROP TABLE IF EXISTS Experience;
DROP TABLE IF EXISTS Education;
DROP TABLE IF EXISTS Profiles;

-- -----------------------------------------------------
-- Table `Profiles`
-- -----------------------------------------------------
CREATE TABLE Profiles (
  id INT PRIMARY KEY AUTO_INCREMENT,
  full_name VARCHAR(255) NOT NULL
);

-- -----------------------------------------------------
-- Table `Education`
-- -----------------------------------------------------
CREATE TABLE Education (
  id INT PRIMARY KEY AUTO_INCREMENT,
  profile_id INT,
  institution VARCHAR(255),
  title VARCHAR(255),
  start_date DATE,
  end_date DATE,
  FOREIGN KEY (profile_id) REFERENCES Profiles(id)
);

-- -----------------------------------------------------
-- Table `Experience`
-- -----------------------------------------------------
CREATE TABLE Experience (
  id INT PRIMARY KEY AUTO_INCREMENT,
  profile_id INT,
  position VARCHAR(255),
  company VARCHAR(255),
  employment_type VARCHAR(100),
  start_date DATE,
  end_date DATE,
  location VARCHAR(255),
  work_mode VARCHAR(100),
  FOREIGN KEY (profile_id) REFERENCES Profiles(id)
);

-- -----------------------------------------------------
-- Table `Certifications`
-- -----------------------------------------------------
CREATE TABLE Certifications (
  id INT PRIMARY KEY AUTO_INCREMENT,
  profile_id INT,
  name VARCHAR(255),
  issuing_organization VARCHAR(100),
  issue_date DATE,
  FOREIGN KEY (profile_id) REFERENCES Profiles(id)
);

-- -----------------------------------------------------
-- Table `Skills`
-- -----------------------------------------------------
CREATE TABLE Skills (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) UNIQUE NOT NULL
);

-- -----------------------------------------------------
-- Junction (Pivot) Tables
-- -----------------------------------------------------
CREATE TABLE Education_Skills (
  education_id INT,
  skill_id INT,
  PRIMARY KEY (education_id, skill_id),
  FOREIGN KEY (education_id) REFERENCES Education(id),
  FOREIGN KEY (skill_id) REFERENCES Skills(id)
);

CREATE TABLE Experience_Skills (
  experience_id INT,
  skill_id INT,
  PRIMARY KEY (experience_id, skill_id),
  FOREIGN KEY (experience_id) REFERENCES Experience(id),
  FOREIGN KEY (skill_id) REFERENCES Skills(id)
);

CREATE TABLE Certification_Skills (
  certification_id INT,
  skill_id INT,
  PRIMARY KEY (certification_id, skill_id),
  FOREIGN KEY (certification_id) REFERENCES Certifications(id),
  FOREIGN KEY (skill_id) REFERENCES Skills(id)
);


-- -----------------------------------------------------
-- DATA INSERTION
-- -----------------------------------------------------

-- 1. Insert the main profile (assuming profile ID 1)
INSERT INTO Profiles (id, full_name) VALUES (1, 'Anonymous Candidate');

-- 2. Insert academic education
INSERT INTO Education (id, profile_id, institution, title, start_date, end_date) VALUES
(1, 1, 'Centre d\'Estudis Politècnics', 'Ciclo Formativo de Grado Superior, Desarrollo de aplicaciones web', '2023-09-01', '2025-05-01'),
(2, 1, 'Centre d\'Estudis Politècnics', 'Ciclo Formativo de Grado Medio, Administración de sistemas informáticos en red', '2021-09-01', '2023-05-01');

-- 3. Insert work experience
INSERT INTO Experience (id, profile_id, position, company, employment_type, start_date, end_date, location, work_mode) VALUES
(1, 1, 'Systems administrator', 'Webedia', 'Part-time', '2025-04-01', '2025-06-01', 'Barcelona, Catalonia, Spain', 'Hybrid'),
(2, 1, 'Técnico informático', 'Entravision', 'Freelance', '2023-12-01', '2025-02-01', 'Barcelona, Cataluña, España', 'On-site'),
(3, 1, 'Especialista en TI', 'Trobalit', 'Freelance', '2023-12-01', '2025-02-01', 'Barcelona, Cataluña, España', 'On-site'),
(4, 1, 'Técnico informático', 'BALNES EUROPE SL', 'Freelance', '2023-12-01', '2024-08-01', 'Barcelona, Cataluña, España', 'Hybrid'),
(5, 1, 'Técnico informático', 'Adsmurai', 'Freelance', '2023-12-01', '2024-03-01', 'Barcelona, Cataluña, España', 'On-site'),
(6, 1, 'Técnico informático', 'COLEGIO JOHN TALABOT SL', 'Part-time', '2023-01-01', '2023-05-01', 'Barcelona, Cataluña, España', 'On-site');

-- 4. Insert certifications
INSERT INTO Certifications (id, profile_id, name, issuing_organization, issue_date) VALUES
(1, 1, 'Amazon Web Services para profesionales IT', 'LinkedIn', '2025-09-01'),
(2, 1, 'React Essential Training', 'LinkedIn', '2025-09-01');

-- 5. Insert ALL unique skills
INSERT INTO Skills (name) VALUES
('Ingeniería informática'), ('Code Refactoring'), ('Equipos informáticos'), ('Microsoft Outlook'), ('Hojas de estilos en cascada (CSS)'),
('Soporte técnico'), ('Lado del servidor'), ('Conocimientos informáticos'), ('Instalación de hardware informático'), ('Optimization'),
('Mail Servers'), ('Interconexión en red'), ('Operaciones de redes informáticas'), ('PHP'), ('Software Engineers'),
('Dynamic Host Configuration Protocol (DHCP)'), ('Virtual Private Network (VPN)'), ('Resolución de problemas'), ('Soporte para impresoras'),
('Debugging'), ('Incident Management'), ('Customer Service'), ('Algorithms'), ('Reasoning Skills'), ('Gestión de redes'),
('Experiencia de usuario'), ('Resolución de problemas de hardware informático'), ('Reparación de equipos informáticos'), ('Java'),
('Ordenadores de sobremesa'), ('Redes inalámbricas'), ('Inglés'), ('Linux System Administration'), ('Operaciones de TI'),
('Experiencia de Active Directory'), ('Windows Server'), ('Microsoft Office'), ('Networking'), ('IT Management'),
('HTML'), ('Apache'), ('Administración de sistemas'), ('Jenkins'), ('Amazon Web Services (AWS)'), ('Attention to Detail'),
('Cloud Infrastructure'), ('Varnish (software)'), ('Communication'), ('Docker Products'), ('Gestión de servicios de TI'),
('Grafana'), ('Linux'), ('Prometheus'), ('Back-End Web Development'), ('Office 356'), ('Help Desk Support'),
('Windows'), ('Google Workspace'), ('Tecnología de la información'), ('Peripherals'), ('Systems Management'),
('VMware'), ('Slack'), ('Mac'), ('Resolución de incidencias'), ('Computer Maintenance'), ('Cisco Meraki'),
('Ordenador portátil'), ('Microsoft Servers'), ('Sistemas informáticos'), ('Infraestructura de tecnologías de la información'),
('Teamwork'), ('React.js'), ('Front-End Development'), ('Web Development');

-- 6. Link skills to each record
-- Skills for Education ID 1 (Higher Grade)
INSERT INTO Education_Skills (education_id, skill_id) SELECT 1, id FROM Skills WHERE name IN 
('Ingeniería informática', 'Code Refactoring', 'Equipos informáticos', 'Microsoft Outlook', 'Hojas de estilos en cascada (CSS)', 'Soporte técnico', 'Lado del servidor', 'Conocimientos informáticos', 'Instalación de hardware informático', 'Optimization', 'Mail Servers', 'Interconexión en red', 'Operaciones de redes informáticas', 'PHP', 'Software Engineers', 'Dynamic Host Configuration Protocol (DHCP)', 'Virtual Private Network (VPN)', 'Resolución de problemas', 'Soporte para impresoras', 'Debugging', 'Incident Management', 'Customer Service', 'Algorithms', 'Reasoning Skills', 'Gestión de redes', 'Experiencia de usuario', 'Resolución de problemas de hardware informático', 'Reparación de equipos informáticos', 'Java', 'Ordenadores de sobremesa', 'Redes inalámbricas', 'Inglés', 'Linux System Administration', 'Operaciones de TI', 'Experiencia de Active Directory', 'Windows Server', 'Microsoft Office', 'Networking');

-- Skills for Education ID 2 (Middle Grade)
INSERT INTO Education_Skills (education_id, skill_id) SELECT 2, id FROM Skills WHERE name IN
('Ingeniería informática', 'Equipos informáticos', 'Soporte técnico', 'Conocimientos informáticos', 'Instalación de hardware informático', 'Interconexión en red', 'Operaciones de redes informáticas', 'IT Management', 'HTML', 'Soporte para impresoras', 'Gestión de redes', 'Resolución de problemas de hardware informático', 'Reparación de equipos informáticos', 'Java', 'Ordenadores de sobremesa', 'Redes inalámbricas', 'Inglés', 'Operaciones de TI', 'Experiencia de Active Directory', 'Microsoft Office');

-- Skills for Experience ID 1 (Webedia)
INSERT INTO Experience_Skills (experience_id, skill_id) SELECT 1, id FROM Skills WHERE name IN
('Lado del servidor', 'Apache', 'Administración de sistemas', 'Jenkins', 'Amazon Web Services (AWS)', 'Ingeniería informática', 'Equipos informáticos', 'Attention to Detail', 'Cloud Infrastructure', 'Varnish (software)', 'Communication', 'Interconexión en red', 'Linux System Administration', 'Docker Products', 'Gestión de servicios de TI', 'IT Management', 'Networking', 'Grafana', 'Gestión de redes', 'Linux', 'Inglés', 'HTML', 'Incident Management', 'Conocimientos informáticos', 'Prometheus', 'Back-End Web Development', 'Hojas de estilos en cascada (CSS)');

-- Skills for Experience ID 2 (Entravision)
INSERT INTO Experience_Skills (experience_id, skill_id) SELECT 2, id FROM Skills WHERE name IN
('Instalación de hardware informático', 'Office 365', 'Administración de sistemas', 'Help Desk Support', 'Operaciones de redes informáticas', 'Ingeniería informática', 'Equipos informáticos', 'Attention to Detail', 'Soporte técnico', 'Microsoft Office', 'Windows', 'Reparación de equipos informáticos', 'Google Workspace', 'Communication', 'Tecnología de la información', 'Interconexión en red', 'Mail Servers', 'Gestión de servicios de TI', 'Peripherals', 'Operaciones de TI', 'IT Management', 'Networking', 'Gestión de redes', 'Virtual Private Network (VPN)', 'Systems Management', 'Linux', 'Inglés', 'Resolución de problemas', 'Soporte para impresoras', 'VMware', 'Incident Management', 'Customer Service', 'Conocimientos informáticos', 'Slack', 'Resolución de problemas de hardware informático', 'Dynamic Host Configuration Protocol (DHCP)', 'Mac', 'Redes inalámbricas', 'Resolución de incidencias', 'Computer Maintenance', 'Ordenadores de sobremesa', 'Cisco Meraki', 'Ordenador portátil');

-- Skills for Experience ID 3 (Trobalit)
INSERT INTO Experience_Skills (experience_id, skill_id) SELECT 3, id FROM Skills WHERE name IN
('Office 365', 'Administración de sistemas', 'Help Desk Support', 'Attention to Detail', 'Soporte técnico', 'Microsoft Servers', 'Microsoft Office', 'Windows', 'Google Workspace', 'Communication', 'Mail Servers', 'Gestión de servicios de TI', 'Peripherals', 'IT Management', 'Sistemas informáticos', 'Windows Server', 'Networking', 'Virtual Private Network (VPN)', 'Systems Management', 'Linux', 'Inglés', 'Resolución de problemas', 'VMware', 'Incident Management', 'Experiencia de Active Directory', 'Customer Service', 'Slack', 'Infraestructura de tecnologías de la información', 'Dynamic Host Configuration Protocol (DHCP)', 'Mac', 'Teamwork', 'Computer Maintenance', 'Cisco Meraki');

-- Skills for Experience ID 4 (BALNES EUROPE SL)
INSERT INTO Experience_Skills (experience_id, skill_id) SELECT 4, id FROM Skills WHERE name IN
('Instalación de hardware informático', 'Office 365', 'Administración de sistemas', 'Help Desk Support', 'Operaciones de redes informáticas', 'Ingeniería informática', 'Equipos informáticos', 'Attention to Detail', 'Microsoft Outlook', 'Soporte técnico', 'Microsoft Servers', 'Microsoft Office', 'Windows', 'Reparación de equipos informáticos', 'Google Workspace', 'Communication', 'Tecnología de la información', 'Interconexión en red', 'Mail Servers', 'Gestión de servicios de TI', 'Peripherals', 'Operaciones de TI', 'IT Management', 'Windows Server', 'Networking', 'Gestión de redes', 'Virtual Private Network (VPN)', 'Systems Management', 'Linux', 'Inglés', 'Resolución de problemas', 'Soporte para impresoras', 'VMware', 'Incident Management', 'Experiencia de Active Directory', 'Customer Service', 'Conocimientos informáticos', 'Slack', 'Resolución de problemas de hardware informático', 'Dynamic Host Configuration Protocol (DHCP)', 'Mac', 'Redes inalámbricas', 'Resolución de incidencias', 'Teamwork', 'Computer Maintenance', 'Ordenadores de sobremesa', 'Cisco Meraki', 'Ordenador portátil');

-- Skills for Experience ID 5 (Adsmurai)
INSERT INTO Experience_Skills (experience_id, skill_id) SELECT 5, id FROM Skills WHERE name IN
('Instalación de hardware informático', 'Office 365', 'Help Desk Support', 'Operaciones de redes informáticas', 'Ingeniería informática', 'Equipos informáticos', 'Attention to Detail', 'Soporte técnico', 'Microsoft Office', 'Windows', 'Reparación de equipos informáticos', 'Google Workspace', 'Communication', 'Tecnología de la información', 'Interconexión en red', 'Gestión de servicios de TI', 'Peripherals', 'Operaciones de TI', 'IT Management', 'Networking', 'Gestión de redes', 'Systems Management', 'Inglés', 'Resolución de problemas', 'VMware', 'Incident Management', 'Customer Service', 'Conocimientos informáticos', 'Slack', 'Resolución de problemas de hardware informático', 'Dynamic Host Configuration Protocol (DHCP)', 'Mac', 'Redes inalámbricas', 'Resolución de incidencias', 'Computer Maintenance', 'Ordenadores de sobremesa', 'Ordenador portátil');

-- Skills for Experience ID 6 (COLEGIO JOHN TALABOT SL)
INSERT INTO Experience_Skills (experience_id, skill_id) SELECT 6, id FROM Skills WHERE name IN
('Instalación de hardware informático', 'Office 365', 'Help Desk Support', 'Operaciones de redes informáticas', 'Ingeniería informática', 'Equipos informáticos', 'Attention to Detail', 'Soporte técnico', 'Microsoft Servers', 'Reparación de equipos informáticos', 'Communication', 'Tecnología de la información', 'Interconexión en red', 'Mail Servers', 'Peripherals', 'Operaciones de TI', 'IT Management', 'Windows Server', 'Networking', 'Gestión de redes', 'Systems Management', 'Inglés', 'Resolución de problemas', 'Soporte para impresoras', 'VMware', 'Incident Management', 'Customer Service', 'Conocimientos informáticos', 'Resolución de problemas de hardware informático', 'Dynamic Host Configuration Protocol (DHCP)', 'Redes inalámbricas', 'Resolución de incidencias', 'Teamwork', 'Computer Maintenance', 'Ordenadores de sobremesa', 'Ordenador portátil');

-- Skills for Certification ID 2 (React Essential Training)
INSERT INTO Certification_Skills (certification_id, skill_id) SELECT 2, id FROM Skills WHERE name IN
('React.js', 'Front-End Development', 'Web Development');

COMMIT;