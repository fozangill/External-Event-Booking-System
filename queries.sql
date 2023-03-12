CREATE TABLE participations (
                                participation_id INT PRIMARY KEY,
                                employee_name VARCHAR(255),
                                employee_mail VARCHAR(255),
                                event_id INT,
                                event_name VARCHAR(255),
                                participation_fee DECIMAL(10,2),
                                event_date DATETIME,
                                version VARCHAR(10)
);

ALTER TABLE 'participations' ADD INDEX('employee_name', 'event_name', 'event_date');
