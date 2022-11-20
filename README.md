# Healther
![image](https://user-images.githubusercontent.com/71490066/202903098-c4fa12db-2b69-402a-83c3-416facb26672.png)

# Authors:
Name: Samuil Georgiev Georgiev
email: samuil.georgiev@outlook.com
School: EG "Geo Milev"
Class: 12e

Name: Iliyan Plamenov Petrov
email: ilko.petrov27@gmail.com
School: "Ivan Vazov" Secondary School
Class: 11a

# Supervisors: 
Maria Kirilova Georgieva
GSM: 0895355091
email: eg.m.kirilova@gmail.com
Senior teacher

Dr. engineer Svetlana Vasileva Boyadzhieva
GSM: 0884164221
email: svetlanaeli@abv.bg

# Summary:
## Objectives:
Our idea was to create a device and an associated Internet application that would measure, analyze and present the characteristics of the air in a room, office or other interior room. Our goal is the collected and analyzed air data - temperature, humidity and pollution to be presented in a user-friendly way and be used for inferences and changes.

## Main stages in the implementation of the project:
The first stage was research on the materials needed for the project.
The second stage was buying the ESP32, sensors, etc., then we built the device.
We distributed the tasks related to programming the web system.
We planned our work and implementation of assigned tasks. In the process of working, we tested the application and the device.

![image](https://user-images.githubusercontent.com/71490066/202903277-39870ff5-3127-4a18-ac11-dd661b6eaa03.png)
![image](https://user-images.githubusercontent.com/71490066/202903279-872ab27d-ef20-4068-98ba-fd412f9dc1fa.png)

## Level of complexity - main problems during the implementation of the set goals:
Connecting the individual parts of the programmable board and reading reliable data from it was the biggest challenge of the project.
Another challenge was presenting data to users. The JavaScript library used to represent data had to be replaced during development.

## Logical and functional description of the solution:
The platform is built with a three-layer architecture - a presentation layer for the user, a large volume of data stored in a database and a business layer - for processing the data and processes.
When registering on the platform, there is a validity check and an email confirmation is required.
The web platform code files are grouped into separate folders by purpose.

# Implementation:
- Programming languages: HTML 5, CSS, JavaScript, PHP, SQL, Arduino C
- Libraries: Bootstrap 5, amCharts, Font Awesome
- Software: GitHub, Visual Studio Code, Sublime Text 3, XAMPP, FileZilla, Adobe Photoshop
- Communication: Discord, Teams
- Others: phpMyAdmin, MySQL, roundcube, AIR Quality Programmatic API
We programmed the board and sensors using Arduino C. The other programming languages were used to build the web platform.
We worked collaboratively online, primarily using GitHub platforms for sharing and sync code and Discord for communication.

## Application Description:
After 'manufacturing' a Healther device, it is registered by an administrator in the database.
The next stage is registration of a user who will activate their device.

![image](https://user-images.githubusercontent.com/71490066/202903965-bd266fcd-b54b-4139-b64d-d677c8e986be.png)

Using their account, any user can access the collected and analyzed data for their system.

A user can have more than one device.
Example: a manager in a company can monitor devices placed in different rooms.

![image](https://user-images.githubusercontent.com/71490066/202904184-5369ff8c-190f-41ca-96f0-296ad9a72a11.png)

Access to the administrative part:
- Email: admin@healther.online
- Password: Healther2020
The device measures and stores data every 5 minutes and thus provides sufficient information.

## Conclusion:
The device is placed in Ilian's home and measures the characteristics of the air in
the last two months. Thanks to the results of the values, we draw conclusions about
fixing some actions in the room. The device has been tested and it has proven its usefulness. We intend to bring it into a portable and attractive form so that it can be offered if desired by customers.
A future functionality of the web application that we intend to implement is the sending of monthly, weekly or daily email reports.

![image](https://user-images.githubusercontent.com/71490066/202904402-3d93852c-bd44-4312-baa2-b2eaf5cec31c.png)
![image](https://user-images.githubusercontent.com/71490066/202904398-5539dbde-c285-43ef-8d7f-a2628a1f552f.png)










